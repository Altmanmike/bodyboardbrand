import React from "react";
import './MemberDetail.css';
import InstagramIcon from '../../icons/InstagramIcon';
import Facebook from '../../icons/FacebookIcon';
import YoutubeIcon from '../../icons/YoutubeIcon';

const MemberDetail = ({  id, nickname, biography, role, photo, sponsors, ranking, facebook, instagram, youtube, createdAt, onBack }) => {
  const formattedDate = new Date(createdAt).toLocaleDateString("en-EN", {
    year: "numeric",
    month: "long",
    day: "numeric",
  });   
    return (
      <div className="member-detail-card member-detail-card-details"> 
        <h3 className="member-detail-title">{nickname}</h3>             
        <img src={photo} alt={nickname} className="member-detail-image" />        
        <div className="member-detail-content">      
          <p className="member-detail-snippet">Rank: {ranking}</p>      
          <p className="member-detail-snippet">Level: {role}</p>
          <h4 className="member-detail-title">Biography</h4> 
          <p className="member-detail-snippet">{biography}</p>
          <h4 className="member-detail-title">Socials</h4>
          <ul className="member-detail-social">
            <li><a href={`${facebook}`}><Facebook /></a></li>
            <li><a href={`${instagram}`}><InstagramIcon /></a></li>
            <li><a href={`${youtube}`}><YoutubeIcon /></a></li>
          </ul>
          <div className="member-detail-footer">
          <span className="member-detail-sponsor">Sponsors: {sponsors}</span>
          <span className="member-detail-date">Joined: {formattedDate}</span>
        </div>
        </div>
        <button onClick={onBack} className="button-back">Back</button>
      </div>
    );
  };
  
  export default MemberDetail;