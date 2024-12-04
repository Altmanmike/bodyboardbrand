import React from 'react';
import { ThemeProvider, useTheme } from './context/ThemeContext';
import Carousel from './pages/Carousel';
import Body from './components/Body';
import Footer from './components/Footer';
import '../styles/App.css';
import toTopButton from '../imgs/totop.png';

const AppContent = () => {
  const { isDarkMode } = useTheme();

  return (
    <div className={isDarkMode ? 'dark-mode' : 'light-mode'}>              
      <div id="scrollUp" >
          <a href="#top"><img src={toTopButton} alt="GO TOP"/></a>
      </div>
      <hr class="grad"></hr>
      <Carousel />      
      <Body />    
      <Footer />
    </div>
  );
};

const App = () => {
  return (
    <ThemeProvider>      
        <AppContent />      
    </ThemeProvider>
  );
};

export default App;