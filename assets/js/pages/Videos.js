// src/pages/Videos.js
import React from 'react';
import VideoCard from '../components/cards/VideoCard';
import './Videos.css';

const Videos = () => {
  const videos = [
    {
      videoId: 'ZeivXGDX6Bk', // Remplacez par un ID de vidéo YouTube valide 
      title: 'Another Team Highlights',
      description: 'Best moments from the K&Z team in 2024 competitions.',
    },
    {
      videoId: 'S6Twm_oofew', 
      title: 'How to Master Aerial Tricks',
      description: 'Step-by-step tutorial by our pro riders.',
    },
    {
      videoId: '--OREA5IU5s',
      title: 'Junior Rider Training Day',
      description: 'A day in the life of our junior riders.',
    },
  ];

  return (
    <section id="videos" className="videos">
      <h2>Our Videos</h2>
      <div className="videos-grid">
        {videos.map((video, index) => (
          <VideoCard key={index} {...video} />
        ))}
      </div>
    </section>
  );
};

export default Videos;
