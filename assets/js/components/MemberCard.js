import React from 'react';
import './MemberCard.css';

const MemberCard = ({ name, role, photo, description, size }) => {
  const cardClass = size ? `${size}-card` : 'small-card';
  return (
    <div className={`member-card ${cardClass}`}>
      <img src={photo} alt={`${name}`} className="member-photo" />
      <h3>{name}</h3>
      <p><strong>{role}</strong></p>
      <p>{description}</p>
    </div>
  );
};
  
export default MemberCard;
