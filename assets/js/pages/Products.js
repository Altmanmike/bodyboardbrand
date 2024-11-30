import React, { useState } from 'react';
import ProductCard from '../components/ProductCard';
import ProductCategoryCard from '../components/ProductCategoryCard';
import './Products.css';
import KzBoard01 from '../../imgs/products/kz-board-01.png';
import KzBoard02 from '../../imgs/products/kz-board-02.png';
import KzFins01 from '../../imgs/products/kz-fins-01.png';
import KzFinsLeash from '../../imgs/products/kz-fins-leash.png';
import KzBoardLeash from '../../imgs/products/kz-board-leash.png';
import KzSweatBlack from '../../imgs/products/kz-sweat-black.png';
import KzSweatWhite from '../../imgs/products/kz-sweat-white.png';
import KzCapBlack from '../../imgs/products/kz-cap-black.png';
import KzCapRed from '../../imgs/products/kz-cap-red.png';
import KzMugBlack from '../../imgs/products/kz-mug-black.png';
import KzKeyRing from '../../imgs/products/kz-key-ring.png';
import KzSticker from '../../imgs/products/kz-sticker.png';

const Products = () => {
  const productData = {
    boards: [
      { id: 1, title: 'Board Alpha', image: KzBoard01, sizes: ['40', '41', '42', '43', '44'] },
      { id: 2, title: 'Board Omega', image: KzBoard02, sizes: ['40', '41', '42', '43', '44'] },
    ],
    gears: [
      { id: 3, title: 'Fins Alpha', image: KzFins01, sizes: ['XS', 'S', 'M', 'L', 'XL', 'XXL'] },
      { id: 4, title: 'Leash Alpha', image: KzFinsLeash, sizes: ['L'] },
      { id: 5, title: 'Leash Omega', image: KzBoardLeash, sizes: ['L'] },
    ],
    clothing: [
      { id: 6, title: 'Sweat Alpha', image: KzSweatBlack, sizes: ['S', 'M', 'L', 'XL'] },
      { id: 7, title: 'Sweat Omega', image: KzSweatWhite, sizes: ['S', 'L', 'XL', 'XXL'] },
      { id: 8, title: 'Cap Alpha', image: KzCapBlack, sizes: ['L'] },
      { id: 9, title: 'Cap Omega', image: KzCapRed, sizes: ['L'] },
    ],
    accessories: [
      { id: 10, title: 'Mug Alpha', image: KzMugBlack, sizes: ['L'] },
      { id: 11, title: 'Key Alpha', image: KzKeyRing, sizes: ['L'] },
      { id: 12, title: 'Sticker Alpha', image: KzSticker, sizes: ['L'] },
    ],
  };

  // Gestion de l'état de la catégorie sélectionnée
  const [selectedCategory, setSelectedCategory] = useState('boards');

  // Récupère les produits de la catégorie sélectionnée
  const products = productData[selectedCategory] || [];
  
  const categoryDetails = {
    boards: {
      title: 'Boards',
      description: 'Ride the waves with our cutting-edge boards, crafted for performance and style.',
    },
    gears: {
      title: 'Gears',
      description: 'Propel yourself with precision using our expertly designed fins for ultimate wave control and keep your board secure with our durable and comfortable leash solutions.',
    },
    clothing: {
      title: 'Clothing',
      description: 'Stay stylish with our exclusive K&Z apparel collection.',
    },
    accessories: {
      title: 'Accessories',
      description: 'Discover innovative accessories to complement your gear.',
    },
  };

 return (
  <section id="products" className="products">
   <h2>Products</h2>
   <div className="products-page">    
    <div className="categories-large">
      {Object.keys(productData).map((category) => (
        <ProductCategoryCard
        key={category}
        title={categoryDetails[category].title}
        description={categoryDetails[category].description}
        isActive={selectedCategory === category}
        onClick={() => setSelectedCategory(category)}
        />
      ))}
    </div>
    <div className="products-grid">
      {products.map((product) => (
        <ProductCard
          key={product.id}
          title={product.title}
          image={product.image}
          sizes={product.sizes}
        />
      ))}
    </div>
   </div>
  </section>
 );
};  

export default Products;