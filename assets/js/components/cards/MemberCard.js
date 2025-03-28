import React from 'react';
import './MemberCard.css';

const MemberCard = ({ id, nickname, biography, role, photo, sponsors, ranking, facebook, instagram, youtube, createdAt }) => {
  const formattedDate = new Date(createdAt).toLocaleDateString("en-EN", {
    year: "numeric",
    month: "long",
    day: "numeric",
  });
  const cardClass = role ? `${role.toLowerCase()}-card` : 'small-card';

  return (
    <div className={`member-card ${cardClass}`}>
      <h3 className="member-title">{nickname}</h3>
      <img src={photo} alt={`${nickname}`} className="member-photo" />
      <div className="member-content">
        <h3 className="member-title">Role: {role}</h3>
        <p className="member-snippet">Ranking: {ranking}</p>
        <div className="member-footer">
          <span className="member-date">{formattedDate}</span>          
        </div>
      </div>
    </div>
  );
};
  
export default MemberCard;
