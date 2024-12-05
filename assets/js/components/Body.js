import React from 'react';
import { useTheme } from '../context/ThemeContext';
import './Body.css';
import Posts from '../pages/Posts';
import Products from '../pages/Products';
import Community from '../pages/Community';
import Videos from '../pages/Videos';
import Innovation from '../pages/Innovation';
import Contact from '../pages/Contact';
import FooterSVG from '../pages/FooterSVG';
import PostsParallax from './parallax/PostsParallax';
import ProductsParallax from './parallax/ProductsParallax';
import CommunityParallax from './parallax/CommunityParallax';
import VideosParallax from './parallax/VideosParallax';
import InnovationParallax from './parallax/InnovationParallax';
import ContactParallax from './parallax/ContactParallax';

const Body = () => {
  const { isDarkMode } = useTheme();

  return (
    <main className={`body ${isDarkMode ? 'dark' : ''}`}>
      <hr class="grad"></hr>
      <PostsParallax/>
      <hr class="grad"></hr>
      <div className="posts-content slide-in-fwd-visible">
        <Posts/>
      </div>
      <hr class="grad"></hr>
      <ProductsParallax/>
      <hr class="grad"></hr>
      <div className='products-content slide-in-fwd-visible'>
        <Products/>
      </div>
      <hr class="grad"></hr>
      <CommunityParallax/>
      <hr class="grad"></hr> 
      <div className="community-content slide-in-fwd-visible">
        <Community/>
      </div>
      <hr class="grad"></hr>
      <VideosParallax/>
      <hr class="grad"></hr>
      <div className="videos-content slide-in-fwd-visible">
        <Videos/>
      </div>
      <hr class="grad"></hr>
      <InnovationParallax/>
      <hr class="grad"></hr>
      <div className="innovation-content slide-in-fwd-visible">
        <Innovation/>
      </div>
      <hr class="grad"></hr>
      <ContactParallax/>
      <hr class="grad"></hr>
      <div className="contact-content slide-in-fwd-visible">
        <Contact/>
      </div>
      <div className="footerSVG-content slide-in-fwd-visible">
        <FooterSVG/>
      </div> 
    </main>
  );
};
                                
export default Body;