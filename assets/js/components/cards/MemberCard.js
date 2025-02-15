import React from 'react';
import './MemberCard.css';

const MemberCard = ({ id, nickname, role, photo, sponsor, instagram, youtube }) => {
  const cardClass = role ? `${role}-card` : 'small-card';
  return (
    <div className={`member-card ${cardClass}`}>
      <img src={photo} alt={`${nickname}`} className="member-photo" />
      <h3>{nickname}</h3>
      <p><strong>{role}</strong></p>
      <p>{sponsor}</p>
      <h2>Social</h2>
      <p>{instagram}</p>
      <p>{youtube}</p>
    </div>
  );
};
  
export default MemberCard;
