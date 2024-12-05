// src/components/VideoCard.js
import React from 'react';
import './VideoCard.css';

const VideoCard = ({ videoId, title, description }) => {
  return (
    <div className="video-card">
      <div className="video-embed">
        <iframe
          src={`https://www.youtube.com/embed/${videoId}`}
          title={title}
          frameBorder="0"
          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
          allowFullScreen
        ></iframe>
      </div>
      <h3 className="video-title">{title}</h3>
      <p className="video-description">{description}</p>
    </div>
  );
};

export default VideoCard;

  