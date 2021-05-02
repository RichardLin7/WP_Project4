const express = require("express");
const app = express();
const mongoose = require("mongoose");
const cors = require('cors');
require('dotenv').config();

//! Middlewares
app.use(cors());
app.use(express.urlencoded({ extended: true }));
app.use(express.json());

//! Import routes
const usersRoute = require('./routes/users');
app.use('/users', usersRoute)


//! HOME ROUTE
app.get("/", (req, res) => {
  res.send("We are on home page");
});


//! Connect to DB
mongoose.connect(
  process.env.DB_CONNECTION,
  { useNewUrlParser: true, useUnifiedTopology: true },
  () => console.log("connected to DB!")
);


//! Start server listening
app.listen(4000, () => {
  console.log("App is now listening on port 4000...");
});
