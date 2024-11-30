import React from 'react';
import './ProductCard.css';

const ProductCard = ({ title, image, sizes }) => {
    return (
      <div className="product-card">
        <img src={image} alt={title} className="product-image" />
        <h3 className="product-title">{title}</h3>
        <div className="product-sizes">
          {sizes.map((size, index) => (
            <button key={index} className="size-button">
              {size}
            </button>
          ))}
        </div>
      </div>
    );
  };
  
  export default ProductCard;
  