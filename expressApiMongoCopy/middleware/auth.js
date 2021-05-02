const jwt = require('jsonwebtoken');

module.exports = (req, res, next) => {
  const token = req.header('token');
  if(!token) return res.status(400).json({ message: "Auth error" });

  try {
    const decoded = jwt.verify(token, "secretString");
    req.user = decoded.user;
    next();
  } catch (error) {
    res.status(500).send({ message: "Invalid Token" });
  }
};