import React from 'react';
import ReactDOM from 'react-dom/client';
import './styles/App.css';
import App from './js/App';

const root = ReactDOM.createRoot(document.getElementById('app'));
root.render(
  <React.StrictMode>
    <App />
  </React.StrictMode>
);
