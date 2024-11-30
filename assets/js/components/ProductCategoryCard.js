import React from 'react';
import './ProductCategoryCard.css';

const ProductCategoryCard = ({ title, description, isActive, onClick }) => {
  return (
    <div
      className={`product-category-card-large ${isActive ? 'active' : ''}`}
      onClick={onClick}
    >
      <h2 className="category-title">{title}</h2>
      <p className="category-description">{description}</p>
    </div>
  );
};

export default ProductCategoryCard;
