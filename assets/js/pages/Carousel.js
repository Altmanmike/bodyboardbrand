import React, { useState } from 'react';
import './Carousel.css';
import Slide01 from '../../imgs/carousel/products.jpg';
import Slide02 from '../../imgs/carousel/community.jpg';
import Slide03 from '../../imgs/carousel/innovation.jpg';

const Carousel = () => {
  const [currentSlide, setCurrentSlide] = useState(0);

  const slides = [
    {
      id: 1,
      title: 'Explore K&Z Products',
      description: 'Find the best gear for your next adventure.',
      image: Slide01,
    },
    {
      id: 2,
      title: 'Join the Community',
      description: 'Connect with bodyboarders around the world.',
      image: Slide02,
    },
    {
      id: 3,
      title: 'Innovation in Bodyboards',
      description: 'Discover the latest innovations in bodyboard design.',
      image: Slide03,
    },
  ];

  const nextSlide = () => {
    setCurrentSlide((prev) => (prev + 1) % slides.length);
  };

  const prevSlide = () => {
    setCurrentSlide((prev) => (prev - 1 + slides.length) % slides.length);
  };

  return (
    <div className="carousel">
      <div
        className="carousel-slides"
        style={{ transform: `translateX(-${currentSlide * 100}%)` }}
      >
        {slides.map((slide) => (
          <div className="carousel-slide" key={slide.id}>
            <img src={slide.image} alt={slide.title} className="slide-image" />
            <div className="slide-content">
              <h2>{slide.title}</h2>
              <p>{slide.description}</p>
            </div>
          </div>
        ))}
      </div>
      <button className="carousel-button prev" onClick={prevSlide}>
        &#8249;
      </button>
      <button className="carousel-button next" onClick={nextSlide}>
        &#8250;
      </button>
    </div>
  );
};

export default Carousel;