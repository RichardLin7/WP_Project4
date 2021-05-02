const express = require("express");
const { check, validationResult } = require("express-validator");
const bcrypt = require("bcryptjs");
const jwt = require("jsonwebtoken");
const router = express.Router();
const User = require("../models/User");
const auth = require("../middleware/auth");

//! DELETE SPECIFIC USER
router.delete("/:userId", async (req, res) => {
	try {
		const removedUser = await User.findByIdAndDelete(req.params.userId);
		res.json(removedUser);
	} catch (error) {
		res.json({ message: error });
	}
});

//! UPDATE SPECIFIC USER
router.patch("/:userId", async (req, res) => {
	try {
		const updatedUser = await User.findByIdAndUpdate(
			req.params.userId,
			{ username: req.body.username },
			{ new: true }
		);
		res.json(updatedUser);
	} catch (error) {
		res.json({ message: error });
	}
});

//! SUBMIT A USER

router.post(
	"/signup",
	[
		check("username", "Please Enter a Valid Username").not().isEmpty(),
		check("password", "Please Enter a Valid Password").isLength({
			min: 6,
		}),
		check("fname", "Please Enter a Valid First Name").not().isEmpty(),
		check("lname", "Please Enter a Valid Last Name").not().isEmpty(),
	],
	async (req, res) => {
		const errors = validationResult(req);
		if (!errors.isEmpty()) {
			return res.status(400).json({
				errors: errors.array(),
			});
		}

		const { username, password, fname, lname } = req.body;
		try {
			let user = await User.findOne({
				username,
			});
			if (user) {
				return res.status(400).json({
					msg: "User Already Exists",
				});
			}
			user = new User({
				username,
				password,
				fname,
				lname,
			});

			const salt = await bcrypt.genSalt(10);
			user.password = await bcrypt.hash(password, salt);

			await user.save();

			const payload = {
				user: {
					id: user.id,
				},
			};

			jwt.sign(
				payload,
				"secretString",
				{
					expiresIn: 10000,
				},
				(err, token) => {
					if (err) throw err;
					res.status(200).json({
						token,
					});
				}
			);
		} catch (error) {
			console.log(err.message);
			res.status(500).send("Error in Saving");
		}
	}
);

router.post(
	"/login",
	[
		check("username", "Please enter a valid username").not().isEmpty(),
		check("password", "Please enter a valid password").isLength({
			min: 6,
		}),
	],
	async (req, res) => {
		const errors = validationResult(req);
		if (!errors.isEmpty()) {
			return res.status(400).json({
				errors: errors.array(),
			});
		}

		const { username, password } = req.body;
		try {
			let user = await User.findOne({
				username,
			});
			if (!user) {
				return res.status(400).json({
					message: "User Does Not Exist",
				});
			}

			const isMatch = await bcrypt.compare(password, user.password);
			if (!isMatch) {
				return res.status(400).json({
					message: "Incorrect Password!",
				});
			}

			const payload = {
				user: {
					id: user.id,
				},
			};

			jwt.sign(
				payload,
				"secretString",
				{
					expiresIn: 3600,
				},
				(err, token) => {
					if (err) throw err;
					res.status(200).json({
						token,
					});
				}
			);
		} catch (error) {
			console.log(error);
			res.status(500).json({
				message: "Server Error",
			});
		}
	}
);

router.get("/me", auth, async (req, res) => {
	try {
		const user = await User.findById(req.user.id);
		res.json(user);
	} catch (error) {
		res.send({ message: "Errror in Fetching User" });
	}
});

module.exports = router;
