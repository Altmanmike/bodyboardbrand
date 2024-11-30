import React from 'react';

const LoginForm = () => {

  return (
    <form className="form-login">
      <h2>Login</h2>
      <input
        type="email"
        className="form-input"
        placeholder="Email"
      />
      <input
        type="password"
        className="form-input"
        placeholder="Password"
      />
      <button className="form-button" type="submit">Login</button>
    </form>
  );
};

export default LoginForm;
