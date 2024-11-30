import React, { useState } from 'react';
import './Header.css';
import { useTheme } from '../context/ThemeContext';
import { Link } from 'react-scroll';
import { FaBars, FaTimes } from 'react-icons/fa';
import { FiSun, FiMoon } from 'react-icons/fi';
import logoDefault from '../../imgs/logo-default.png';
import logoHover from '../../imgs/logo-hover.png';
import HomeIcon from '../icons/HomeIcon';
import ProductsIcon from '../icons/ProductsIcon';
import CommunityIcon from '../icons/CommunityIcon';
import VideosIcon from '../icons/VideosIcon';
import InnovationIcon from '../icons/InnovationIcon'; 
import ContactIcon from '../icons/ContactIcon';
import LoginForm from './LoginForm';
import './LoginForm.css';

const Header = () => {
  const { isDarkMode, toggleTheme } = useTheme();

  const [isHovered, setIsHovered] = useState(false);
  const [menuOpen, setMenuOpen] = useState(false);

  const toggleMenu = () => setMenuOpen(!menuOpen);

  const [showLoginPopup, setShowLoginPopup] = useState(false);

  /* to change */
  const isLoggedIn = false;
  const logout = false;
  
  return (
    <header className={`header ${isDarkMode ? 'dark' : ''}`}>
      <div
        className="logo"
        onMouseEnter={() => setIsHovered(true)}
        onMouseLeave={() => setIsHovered(false)}
      >
        <img
          src={isHovered ? logoHover : logoDefault}
          alt="K&Z Logo"
          className="logo-image"
        />
      </div>

      {/* Burger Menu Icon */}
      <div className="menu-toggle" onClick={toggleMenu}>
        {menuOpen ? <FaTimes /> : <FaBars />}
      </div>

      {/* Navigation */}
      <nav className={`nav ${menuOpen ? 'open' : ''}`}>
        <ul className="nav-links">
          <li><Link to="posts" smooth={true} duration={500} onClick={toggleMenu}><HomeIcon /> Home</Link></li>
          <li><Link to="products" smooth={true} duration={500} onClick={toggleMenu}><ProductsIcon /> Products</Link></li>
          <li><Link to="community" smooth={true} duration={500} onClick={toggleMenu}><CommunityIcon /> Community</Link></li>
          <li><Link to="videos" smooth={true} duration={500} onClick={toggleMenu}><VideosIcon /> Videos</Link></li>
          <li><Link to="innovation" smooth={true} duration={500} onClick={toggleMenu}><InnovationIcon /> Innovation</Link></li>            
          <li><Link to="contact" smooth={true} duration={500} onClick={toggleMenu}><ContactIcon /> Contact</Link></li>
          <li>
            {/* User Authentication */}
            <div className="auth-section">
              {isLoggedIn ? (
                <button onClick={logout} className="logout-button">Logout</button>
              ) : (
                <button className="login-button" onClick={() => setShowLoginPopup(true)}>Login</button>
              )}
            </div>
            {/* Login Popup */}
            {showLoginPopup && (
              <div className="login-popup">
                <div className="login-popup-content">
                  <button className="close-popup" onClick={() => setShowLoginPopup(false)}>X</button>
                  <LoginForm />
                </div>
              </div>
            )}
          </li>
        </ul>
      </nav>

      {/* Theme Toggle Button */}
      <button className="theme-toggle-button" onClick={toggleTheme}>
        {isDarkMode ? <FiSun size={24} /> : <FiMoon size={24} />}
      </button>
    </header>
  );
};

export default Header;