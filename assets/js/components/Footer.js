import React, { useState }  from 'react';
import { useTheme } from '../context/ThemeContext';
import './Footer.css';
import logoDefault from '../../imgs/logo-default.png';
import logoHover from '../../imgs/logo-hover.png';
import DiscordIcon from '../icons/DiscordIcon';
import WhatsappIcon from '../icons/WhatsappIcon';
import InstagramIcon from '../icons/InstagramIcon';
import Facebook from '../icons/FacebookIcon';
import TwitterIcon from '../icons/TwitterIcon';
import YoutubeIcon from '../icons/YoutubeIcon';

const Footer = () => {
  const { isDarkMode } = useTheme();
  const [isHovered, setIsHovered] = useState(false);

  return (
    <footer className={`footer ${isDarkMode ? 'dark' : ''}`}>      
      <div className="footer-sections">
        {/* About Section */}
        <div className="footer-about">
          <h4>About K&Z</h4>
          <p>
            K&Z is a bodyboarding brand dedicated to innovation and performance, supporting riders worldwide.
          </p>
        </div>
        {/* Links Section */}
        <div className="footer-links">
          <h4>Quick Links</h4>
          <ul>
            <li><a href="#home">Home</a></li>
            <li><a href="#products">Products</a></li>
            <li><a href="#community">Community</a></li>
            <li><a href="#videos">Videos</a></li>
            <li><a href="#innovation">Innovation</a></li>
            <li><a href="#contact">Contact</a></li>
          </ul>
        </div>

        {/* Logo Section */}
        <div
          className="footer-logo"
          onMouseEnter={() => setIsHovered(true)}
          onMouseLeave={() => setIsHovered(false)}
        >
          <img
            src={isHovered ? logoHover : logoDefault}
            alt="K&Z Logo"
            className="footer-logo-image"
          />
        </div>

        {/* Infos Section */}
        <div className="footer-infos">
          <h4>Contact Us</h4>
          <p>Email: <a href="mailto:support@kz.fr">support@kz.fr</a></p>
          <p>Phone: +33 08 11 22 33 44</p>
          <p>Location: 123 Ocean Drive, Morey City</p>
        </div>
        {/* Social Media Section */}
        <div className="footer-social">
          <h4>Follow Us</h4>
          <ul>
            <li><a href="https://discord.com"><DiscordIcon /></a></li>
            <li><a href="https://whatsup.com"><WhatsappIcon /></a></li>
            <li><a href="https://instagram.com"><InstagramIcon /></a></li>
            <li><a href="https://facebook.com"><Facebook /></a></li>
            <li><a href="https://twitter.com"><TwitterIcon /></a></li>
            <li><a href="https://youtube.com"><YoutubeIcon /></a></li>
          </ul>
        </div>
        {/* Bottom Bar */}
        <div className="footer-bottom">
          <p>&copy; 2024 K&Z. All rights reserved.</p>
        </div>
      </div>      
    </footer>
  );
};

export default Footer;