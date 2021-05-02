const mongoose = require('mongoose');

const UserSchema = mongoose.Schema({
  username: {
    type: String,
    required: true
  },
  password: {
    type: String,
    required: true
  },
  fname: {
    type: String,
    required: true
  },
  lname: {
    type: String,
    required: true
  },
  creditcard: {
    type: String,
    default: ''
  },
  booked_flight: {
    type: String,
    default: ''
  },
  booked_parking_space: {
    type: String,
    default: ''
  },
  createdAt: {
    type: Date,
    default: Date.now()
  }
});

module.exports = mongoose.model('Users', UserSchema);