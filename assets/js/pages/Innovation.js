import React from 'react';
import InnovationCard from '../components/InnovationCard';
import './Innovation.css';
import ImgInnov01 from '../../imgs/innovation/stringers.jpg';
import ImgInnov02 from '../../imgs/innovation/fins.jpg';
import ImgInnov03 from '../../imgs/innovation/leash.jpg';

const Innovation = () => {
  const innovations = [
    {
      title: 'Reinforced Board Stringers',
      image: ImgInnov01,
      description: 'New stringer technology for improved board flexibility and strength.',
    },
    {
      title: 'Hydrodynamic Fins',
      image: ImgInnov02,
      description: 'Innovative fins design for better water flow and speed.',
    },
    {
      title: 'Eco-Friendly Leash',
      image: ImgInnov03,
      description: 'Sustainable materials to minimize ocean pollution.',
    },
  ];

  return (
    <section id="innovation" className="innovation">
      <h2>Innovation</h2>
      <div className="innovation-grid">
        {innovations.map((item, index) => (
          <InnovationCard key={index} {...item} />
        ))}
      </div>
    </section>
  );
};

export default Innovation;
