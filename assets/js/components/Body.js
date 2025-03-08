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

const Body = ({ data }) => {
  
  const { isDarkMode } = useTheme();

  return (
    <main className={`body ${isDarkMode ? 'dark' : ''}`}>
      <hr className="grad"></hr>
      <PostsParallax/>
      <hr className="grad"></hr>
      <div className="posts-content slide-in-fwd-visible">
        <Posts posts={JSON.parse(data.posts)} />
      </div>
      <hr className="grad"></hr>
      <ProductsParallax/>
      <hr className="grad"></hr>
      <div className='products-content slide-in-fwd-visible'>
        <Products products={JSON.parse(data.products)} />
      </div>
      <hr className="grad"></hr>
      <CommunityParallax/>
      <hr className="grad"></hr> 
      <div className="community-content slide-in-fwd-visible">
        <Community members={JSON.parse(data.members)} />
      </div>
      <hr className="grad"></hr>
      <VideosParallax/>
      <hr className="grad"></hr>
      <div className="videos-content slide-in-fwd-visible">
        <Videos videos={JSON.parse(data.videos)} />
      </div>
      <hr className="grad"></hr>
      <InnovationParallax/>
      <hr className="grad"></hr>
      <div className="innovation-content slide-in-fwd-visible">
        <Innovation innovations={JSON.parse(data.innovations)} />
      </div>
      <hr className="grad"></hr>
      <ContactParallax/>
      <hr className="grad"></hr>
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