import React from "react";
import './InnovationDetail.css';

const InnovationDetail = ({ id, title, image, content, user, createdAt, onBack }) => {
  const formattedDate = new Date(createdAt).toLocaleDateString("en-EN", {
    year: "numeric",
    month: "long",
    day: "numeric",
  });   
    return (
      <div className="innovation-detail-card innovation-detail-card-details">  
        <h3 className="innovation-detail-title">{title}</h3>    
        <img src={image} alt={title} className="innovation-detail-image" />
        <div className="innovation-detail-content">        
          <p className="innovation-detail-snippet">{content}</p>
          <div className="innovation-detail-footer">
          <span className="innovation-detail-author">By {user.lastname}</span>
          <span className="innovation-detail-date">{formattedDate}</span>
        </div>
        </div>
        <button onClick={onBack} className="button-back">Back</button>
      </div>
    );
  };
  
  export default InnovationDetail;