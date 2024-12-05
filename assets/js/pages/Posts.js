import React from 'react';
import PostCard from '../components/cards/PostCard';
import './Posts.css';
import ImgPost01 from '../../imgs/posts/waves.jpg';
import ImgPost02 from '../../imgs/posts/tricks.jpg';
import ImgPost03 from '../../imgs/posts/gear.jpg';

const Posts = () => {
  const posts = [
    {
      title: 'Exploring the Waves',
      image: ImgPost01,
      content: 'Discover the best spots for bodyboarding this summer.',
      author: 'Jane Doe',
      date: 'November 10, 2024',
    },
    {
      title: 'Top 5 Bodyboard Tricks',
      image: ImgPost02,
      content: 'Learn the most exciting tricks to level up your skills.',
      author: 'John Smith',
      date: 'November 12, 2024',
    },
    {
      title: 'Maintaining Your Gear',
      image: ImgPost03,
      content: 'Tips to ensure your bodyboard and fins last longer.',
      author: 'Emily Brown',
      date: 'November 14, 2024',
    },
  ];

  return (
    <section id="posts" className="posts">      
      <h2>Latest Articles</h2>
      <div className="posts-grid">
        {posts.map((post, index) => (
          <PostCard key={index} {...post} />
        ))}
      </div>
    </section>
  );
};

export default Posts; 