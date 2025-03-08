import React from 'react';
import { ThemeProvider, useTheme } from './context/ThemeContext';
import Carousel from './pages/Carousel';
import Body from './components/Body';
import Footer from './components/Footer';
import '../styles/App.css';
import toTopButton from '../imgs/totop.png';

const AppContent = () => {
  const { isDarkMode } = useTheme();

  const rootElement = document.getElementById("app");
  const data = JSON.parse(rootElement.getAttribute("data-all"));

  return (
    <div className={isDarkMode ? 'dark-mode' : 'light-mode'}>              
      <div id="scrollUp" >
          <a href="#top"><img src={toTopButton} alt="GO TOP"/></a>
      </div>
      <hr className="between"></hr>
      <Carousel />       
      <Body data={data} />    
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