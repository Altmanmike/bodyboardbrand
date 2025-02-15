import React from 'react';
import MemberCard from '../components/cards/MemberCard';
import './Community.css';
import ImgLeader from '../../imgs/members/leader.jpg';
import ImgPro1 from '../../imgs/members/pro1.jpg';
import ImgPro2 from '../../imgs/members/pro2.jpg';
import ImgJunior1 from '../../imgs/members/junior1.jpg';
import ImgJunior2 from '../../imgs/members/junior2.jpg';
import ImgPhoto1 from '../../imgs/members/photo1.jpg';
import ImgPhoto2 from '../../imgs/members/photo2.jpg';
import ImgCoord from '../../imgs/members/coord.jpg';
import ImgDev from '../../imgs/members/dev.jpg';

const Community = ({ members}) => {
  /*const members = [
    { name: 'Alex Leader', role: 'Leader', photo: ImgLeader, description: 'Champion and motivator', size: 'leader' },
    { name: 'Pro Rider 1', role: 'Pro-Amateur', photo: ImgPro1, description: 'Experienced rider', size: 'pro' },
    { name: 'Pro Rider 2', role: 'Pro-Amateur', photo: ImgPro2, description: 'Wave crusher', size: 'pro' },
    { name: 'Junior Rider 1', role: 'Junior', photo: ImgJunior1, description: 'Young talent', size: 'junior' },
    { name: 'Junior Rider 2', role: 'Junior', photo: ImgJunior2, description: 'Future star', size: 'junior' },
    { name: 'Photographer 1', role: 'Photographer', photo: ImgPhoto1, description: 'Capturing moments', size: 'small' },
    { name: 'Photographer 2', role: 'Photographer', photo: ImgPhoto2, description: 'Creative shots', size: 'small' },
    { name: 'Event Coordinator', role: 'Coordinator', photo: ImgCoord, description: 'Organizing greatness', size: 'small' },
    { name: 'R&D Developer', role: 'Developer', photo: ImgDev, description: 'Innovating gears', size: 'small' },    
  ];*/

  return (
    <section id="community" className="community">
      <h2>Meet the Team</h2>
      <div className="community-grid">
        {members.map((member, id) => (
          <MemberCard key={id} {...member} />
        ))}
      </div>
    </section>
  );
};

export default Community;