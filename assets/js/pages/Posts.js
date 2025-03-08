import React, { useState } from 'react';
import PostCard from '../components/cards/PostCard';
import './Posts.css';
import ImgPost01 from '../../imgs/posts/waves.jpg';
import ImgPost02 from '../../imgs/posts/tricks.jpg';
import ImgPost03 from '../../imgs/posts/gear.jpg';
import PostDetail from '../components/details/PostDetail';

/*const Posts = ({ posts }) => {  
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
  ];*/

const Posts = ({ posts }) => {  
  const [selectedPost, setSelectedPost] = useState(null);

  const handlePostClick = (post) => {
    setSelectedPost(post); 
  };

  const handleBack = () => {
    setSelectedPost(null); 
  };

  return (
    <section id="posts" className="posts">      
      <h2>Latest Articles</h2>
      {
        selectedPost
        ? <PostDetail {...selectedPost} onBack={handleBack} />
        : <div className="posts-grid">
          {
            posts.map((post) => (
              <div key={post.id} onClick={() => handlePostClick(post)}>
                <PostCard key={post.id} {...post} />
              </div>
            ))
          }
        </div>
      }
    </section>
  );
};

export default Posts;