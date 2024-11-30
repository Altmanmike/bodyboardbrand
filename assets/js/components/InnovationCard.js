import React from 'react';
import './InnovationCard.css';

const InnovationCard = ({ title, image, description }) => {
  return (
    <div className="innovation-card">
      <img src={image} alt={title} className="innovation-image" />
      <h3 className="innovation-title">{title}</h3>
      <p className="innovation-description">{description}</p>
    </div>
  );
};

export default InnovationCard;
