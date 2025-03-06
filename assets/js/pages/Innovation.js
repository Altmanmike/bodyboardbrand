import React, { useState } from 'react';
import InnovationCard from '../components/cards/InnovationCard';
import './Innovation.css';
import ImgInnov01 from '../../imgs/innovation/stringers.jpg';
import ImgInnov02 from '../../imgs/innovation/fins.jpg';
import ImgInnov03 from '../../imgs/innovation/leash.jpg';
import InnovationDetail from '../components/details/InnovationDetail';

const Innovation = ({ innovations }) => {
  /*const innovations = [
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
  ];*/

  const [selectedInnovation, setSelectedInnovation] = useState(null);

  const handleInnovationClick = (innovation) => {
    setSelectedInnovation(innovation);
  }

  const handleBack = () => {
    setSelectedInnovation(null);
  }

  return (
    <section id="innovation" className="innovation">
      <h2>Innovation</h2>
      {
        selectedInnovation
        ? <InnovationDetail {...selectedInnovation} onBack={handleBack} />
        : <div className="innovation-grid">
          {
            innovations.map((innovation) => (
              <div key={innovation.id} onClick={() => handleInnovationClick(innovation)}>
                <InnovationCard key={innovation.id} {...innovation} />
              </div>
            ))
          }
        </div>
      }
    </section>
  );
};

export default Innovation;
