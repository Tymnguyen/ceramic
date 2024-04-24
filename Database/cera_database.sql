-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2024 at 06:46 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cera_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog_article`
--

CREATE TABLE `blog_article` (
  `id` int(11) NOT NULL,
  `coverimage` varchar(250) NOT NULL,
  `originalcoverimage` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `blogcategoryid` int(11) NOT NULL,
  `content` text NOT NULL,
  `viewcount` int(11) NOT NULL DEFAULT 0,
  `deleted` bit(1) NOT NULL DEFAULT b'0',
  `createdat` datetime DEFAULT NULL,
  `createdby` int(11) DEFAULT NULL,
  `lastmodifiedat` datetime DEFAULT NULL,
  `lastmodifiedby` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blog_article`
--

INSERT INTO `blog_article` (`id`, `coverimage`, `originalcoverimage`, `name`, `description`, `blogcategoryid`, `content`, `viewcount`, `deleted`, `createdat`, `createdby`, `lastmodifiedat`, `lastmodifiedby`) VALUES
(1, '65f028594f589.jpg', 'blog-100522.jpg', 'Live Amidst Nature With NITCO’s Nature-Inspired Tiles', 'We chose to delve deeply into NITCO\'s nature-inspired philosophy', 1, '<p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">We chose to delve deeply into NITCO\'s nature-inspired philosophy. Join us on an exploratory journey of design, texture, and feel of the products, from origin and production to implementation. Learn more about how NITCO\'s journey has been an eco-friendly experience and how the products reflect nature.</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">If we had to pick one positive effect of the pandemic, it would be that it made us realize the innate need of humans to connect with nature and the importance of bringing Mother Nature into our living space. Using nature as inspiration has allowed designers to be creative and build spaces that incorporate nature into various aspects.</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">NITCO tiles boast a design philosophy inspired by nature and aim to reunite individuals with the essential resource of Earth - Clay. NITCO’s nature-inspired tiles accurately represent three aspects of nature: aesthetic immensity, transcendence to calm and wellness, and simplicity in composure.</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">A home that vaunts the goodness of nature in the light of serenity and wellness just by the portrayal of the homeowner’s love for Mother Nature in terms of displaying its inspiration through multiple elements in the home such as decorative wall tiles in the living room or the&nbsp;</span><a href=\"https://www.nitco.in/bedroom-floor-tiles?utm_source=google&amp;utm_medium=website-blog&amp;utm_campaign=april-22&amp;utm_term=bedroom-flooring\" rel=\"noopener noreferrer\" target=\"_blank\" style=\"background-color: transparent; color: rgb(0, 0, 0);\">bedroom flooring</a><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">&nbsp;and maybe even an exquisite choice of tiles for&nbsp;</span><a href=\"https://www.nitco.in/bathroom-floor-tiles?utm_source=google&amp;utm_medium=website-blog&amp;utm_campaign=april-22&amp;utm_term=bathroom-flooring\" rel=\"noopener noreferrer\" target=\"_blank\" style=\"background-color: transparent; color: rgb(0, 0, 0);\">bathroom flooring</a><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">. Here are a few options from NITCO tiles you must consider for a home inspired by nature and the feeling of serenity:</span></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Lost in the woods</strong></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\"><img src=\"https://www.nitco.in/assets/nitco-images/blog/main/lost-in-the-woods.jpg\"></span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">These glazed vitrified tiles are perfect for your bedroom floor. The scratch-resistant tiles will give your bedroom a wooden cabinet like aesthetic and are suitable for your kids to play around with and grow through the years that come by. These&nbsp;</span><a href=\"https://www.nitco.in/wooden-floor-tiles?utm_source=google&amp;utm_medium=website-blog&amp;utm_campaign=april-22&amp;utm_term=wooden-floor-tiles\" rel=\"noopener noreferrer\" target=\"_blank\" style=\"background-color: transparent; color: rgb(0, 0, 0);\">wooden floor tiles</a><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">&nbsp;are immensely accurate for the luxurious yet subtle interiors. Moreover, they are easier to maintain than wooden flooring and are not susceptible to any damage in case of water spillage.</span></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">A glimpse of the Grey</strong></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\"><img src=\"https://www.nitco.in/assets/nitco-images/blog/main/A-glimpse-of-the-grey.jpg\"></span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">The Iltas Grey Decor&nbsp;</span><a href=\"https://www.nitco.in/wall-tiles?utm_source=google&amp;utm_medium=website-blog&amp;utm_campaign=april-22&amp;utm_term=wall-tiles\" rel=\"noopener noreferrer\" target=\"_blank\" style=\"background-color: transparent; color: rgb(0, 0, 0);\">wall tiles</a><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">&nbsp;display an earthy stone vibe that perfectly blends with an elegant bathroom interior to fit your nature-inspired home décor. Your bathroom will look nothing less than a holiday home amidst a forest, adding a hint of black furniture and a few indoor plants.</span></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Green Dream</strong></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\"><img src=\"https://www.nitco.in/assets/nitco-images/blog/main/Green-Dream.jpg\"></span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">This green&nbsp;</span><a href=\"https://www.nitco.in/mosaic-floor-tiles?utm_source=google&amp;utm_medium=website-blog&amp;utm_campaign=april-22&amp;utm_term=mosaic-flooring\" rel=\"noopener noreferrer\" target=\"_blank\" style=\"background-color: transparent; color: rgb(0, 0, 0);\">mosaic flooring</a><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">&nbsp;not just lives up to your expectations of a resemblance to nature in your home but also brings about a feeling of serenity and wellness. These tiles from the Naturale collection can be used as wall tiles in the bathroom along with wooden furniture to set a forest-like scene in the bathroom.</span></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Ceramic saga</strong></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\"><img src=\"https://www.nitco.in/assets/nitco-images/blog/main/ceramic-saga.jpg\"></span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">These&nbsp;</span><span style=\"background-color: transparent; color: rgb(0, 0, 0);\">ceramic tiles</span><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">&nbsp;from our Ultima Digital collection will enhance the beauty of your bathroom interiors, making it look minimal, nature-inspired yet exceptionally unique. Adding a hint of whites like in the picture, will give your bathroom a tasteful look with a subtle appearance.</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">When it comes to living a luxurious life amidst nature, it becomes easier to feel serenity and bliss. But, to live in the urbane and expect a nature-inspired life is a dream for almost all. NITCO fulfils that dream of many with a wide range of tiles which are the perfect combination of the philosophy and inspiration from Mother Nature.</span></p><p><br></p>', 18, b'0', '2024-03-12 10:03:05', 1, '2024-03-12 10:03:24', 1),
(2, '65f028c6d2388.jpg', 'blog-1112021.jpg', 'Bring In The Merriment With These Decorative Kitchen Tiles', 'The kitchen can easily be labeled as the \'hub of the home\'', 1, '<p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">The kitchen can easily be labeled as the \'hub of the home\'. With celebrations moving indoors and house parties becoming a part of our routines, kitchen spaces are no longer limited to a corner of the house only entered by the females. Instead, meals are prepared while chatting with loved ones.</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">When it comes to festive celebrations, the importance of kitchens at home increases manifold, and it offers to be the perfect place for bonding. As we approach Christmas and the holiday season, it’s time to host friends and family at home. This is the ideal time to begin prep and give a beautiful makeover to an essential space in your house – the kitchen. With a modest investment, you can change how your kitchen looks and add in some festive joy and cheer by renewing your kitchen tiles and backsplashes. Here are some of our favorite ideas perfect for the holiday season and even after:</span></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">1.&nbsp;A Classic Pistachio Green</strong></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\"><img src=\"https://www.nitco.in/nitcoassets/blog/main/Pistachio.jpg\"></span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Inspired by nature, green tones help bring in a sense of calm, reduce stress, and promote harmony.</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Helix Pistachio mosaic tiles are a fantastic option for kitchen wall design. These beautiful kitchen tiles instantly improve the overall look of your space and ensure you enjoy your time spent here.</span></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">2.&nbsp;The Seasonal Green</strong></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\"><img src=\"https://www.nitco.in/nitcoassets/blog/main/seasonal-green.jpg\"></strong></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">The dark green hue of Helix Olive mosaic tiles works well with various kitchen accessories while adding vibrancy to the space. These designer kitchen tiles make beautiful backsplashes for a modern and contemporary kitchen.</span></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">3.&nbsp;Spreading The Festive Cheer</strong></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\"><img src=\"https://www.nitco.in/nitcoassets/blog/main/spreading-the-festive-cheer.jpg\"></span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">A convivial kitchen atmosphere is the most crucial aspect of a warm and welcoming home. If you are looking for&nbsp;</span><a href=\"https://www.nitco.in/kitchen-tiles\" rel=\"noopener noreferrer\" target=\"_blank\" style=\"background-color: transparent; color: rgb(0, 0, 0);\">kitchen tile ideas</a><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">&nbsp;to add some festive touches while keeping it classic, our Blossom mosaic tiles are the best bet. As in the image here, black and white tiles with floral patterns enhance the all-black kitchen unit.&nbsp;</span></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">4.&nbsp;Wonder Walls</strong></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\"><img src=\"https://www.nitco.in/nitcoassets/blog/main/wonder%20-walls.jpg\"></span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">With an outstanding design that grabs your attention instantly, Helix Blend tiles make fabulous modular kitchen wall tiles.</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Stain-proof, easy to maintain, and clean, these tiles break the monotony of an all-wood kitchen unit.</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">This holiday season, give your kitchen a grand makeover and bring in positivity with these beautiful kitchen tiles and backsplashes.</span></p><p><br></p>', 0, b'0', '2024-03-12 10:04:54', 1, NULL, NULL),
(3, '65f029409fbf3.jpg', 'blog-101021.jpg', 'Get Your Home Ready For The Festive Season', 'Top picks that are perfect to add vibrancy and liveliness to your current space', 1, '<p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">One of the fondest memories of prepping for the festival of lights is ensuring our homes are ready for the number of guests coming over and to welcome the Goddess of Wealth – Goddess Laxmi. Whether it is a complete deep clean or a makeover, we all go the extra mile when it comes to getting our homes ready for Diwali and the festive season. If you are looking at sprucing up your space and adding a touch of glam to it, NITCO has a wide range of wall tiles that will help you brighten up your home. Here are our top picks that are perfect to add vibrancy and liveliness to your current space.</span></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">The Rustic Touch&nbsp;</strong></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\"><img src=\"https://www.nitco.in/nitcoassets/blog/main/cotto-fleur-decor.jpg\"></strong></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">For those who love the vintage, rustic vibe and want to bring that into their space, NITCO’s&nbsp;</span><a href=\"https://www.nitco.in/product-details?search-products&amp;product=cotto-fleur-decor_ntwtl032udl26105\" rel=\"noopener noreferrer\" target=\"_blank\" style=\"background-color: transparent; color: rgb(0, 0, 0);\">Cotto Fleur Décor wall tiles</a><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">&nbsp;are the best choice for you. With minimalistic white flowers digitally printed over a terracotta brown base, these tiles can instantly lend your space the festive uplift. Whether it is for the bathroom or for the outdoors, these tiles will definitely add warmth to your home.</span></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Keepin’ It Classy</strong></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\"><img src=\"https://www.nitco.in/nitcoassets/blog/main/enso-decor.jpg\"></strong></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">The</span><a href=\"https://www.nitco.in/product-details?search-products&amp;product=enso-decor_ntwtl032udl26305\" rel=\"noopener noreferrer\" target=\"_blank\" style=\"background-color: transparent; color: rgb(0, 0, 0);\">&nbsp;Enso Décor wall tiles</a><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">&nbsp;are an apt addition to your home if you like it simple, minimalistic and sophisticated. The combination of grey, white and gold is a classic and will never go out of trend. These ceramic wall tiles are easy to maintain and give your space an instant style quotient. The tiles are joint free, which make them easier to clean and look absolutely flawless when fitted together.</span></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Simple Yet Elegant</strong></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\"><img src=\"https://www.nitco.in/nitcoassets/blog/main/bruno-decor.jpg\"></strong></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Nothing beats a glossy marble finish wall tile. With a blend of brown and beige, the webbed&nbsp;</span><a href=\"https://www.nitco.in/product-details?wall-tiles-collection&amp;product=bruno-decor_ntwtl032udl27305\" rel=\"noopener noreferrer\" target=\"_blank\" style=\"background-color: transparent; color: rgb(0, 0, 0);\">Bruno Décor wall tiles</a><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">&nbsp;create an impact like no other. These tiles create a gorgeous surface that’s eye-catching and lovely. The dynamic effect that the tiles exude will add vibrancy and are just perfect for the festive season.</span></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Soothing &amp; Calming</strong></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\"><img src=\"https://www.nitco.in/nitcoassets/blog/main/hermes-grey-decor.jpg\"></strong></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">The delicate dark and light grey design on the&nbsp;</span><a href=\"https://www.nitco.in/product-details?wall-tiles-collection&amp;product=hermes-grey-decor_ntwtl032udl27005\" rel=\"noopener noreferrer\" target=\"_blank\" style=\"background-color: transparent; color: rgb(0, 0, 0);\">Hermes Grey Decor wall tiles</a><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">&nbsp;lend a calm and relaxed vibe to your space. A band of these tiles with a combination of pure grey tiles will give your room a harmonious colour palette and boost the overall look of the room.</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">These wall tiles are easy to maintain as they are&nbsp;</span><a href=\"https://www.nitco.in/ceramic-wall-tiles\" rel=\"noopener noreferrer\" target=\"_blank\" style=\"background-color: transparent; color: rgb(0, 0, 0);\">ceramic wall tiles&nbsp;</a><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">and also affordable. They can instantly change the vibe of your space with their elegant patterns that can be integrated flawlessly into any space. Don’t miss out on exploring our range of NITCO&nbsp;</span><a href=\"https://www.nitco.in/wall-tiles\" rel=\"noopener noreferrer\" target=\"_blank\" style=\"background-color: transparent; color: rgb(0, 0, 0);\">wall tiles</a><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">&nbsp;that will be a great addition this festive season.</span></p><p><br></p>', 0, b'0', '2024-03-12 10:06:56', 1, NULL, NULL),
(4, '65f029626e9ee.jpg', 'blog-2-november22.jpg', '6 Care Tips To Keep Those Tiles Shining!', 'Here are six easy tips to keep your tiles shining!', 2, '<p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">There is a tonne of lovely tiles on the market! They all make beautiful additions to your home, whether made of ceramic, copper, or hand-painted materials. However, one issue you could run into after purchasing them for your home is tile maintenance. It is a significant issue since you need extra care to prevent cracks and keep them tidy. We understand that you wouldn´t want to live with stains that never disappear. Along with negligence, other things could shorten the lifespan of your lovely tiles and leave stains in your ideal house. On the other hand, if they are not adequately treated, stains could be nothing less than permanent scars. Although cleaning tile floors may seem tedious, it is pretty simple.</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Here are six easy tips to keep your tiles shining!</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">It is best to seal the tiles after installation to prevent infiltration. Since the majority of ceramic tiles are glazed, you won´t have to worry about water or other liquids penetrating the surface and staining the tile. If you don´t have glazed tiles, you might think about coating the tile´s surface with a sealer to make it water and oil-resistant.</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Avoid relocating heavy furniture without a need, and get thick, high-quality matting or even safety padding to place under your heavy furniture. Your tiles will be safer and more secure as a result of this. Keeping your tiles and home looking beautiful might not be too difficult. By maintaining your tiles with the aforementioned advice, you can save money by avoiding having to redo your flooring now and then.</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Tiles can be difficult to keep clean, and aggressive cleaning agents might permanently harm the finish. Use a warm water-and-soapless mild cleanser mixture on a damp sponge mop. Whatever cleaning you use, ensure it is neutral-not acidic or alkaline. Polished marble tiles will get dull if you use acid-based cleansers. Using a solution of white vinegar and warm water to remove common stains could be helpful. Clean the stains with a sponge and watch the magic happen. Make sure the area thoroughly dries. It´s possible that you don´t want the soap traces to be a further issue.</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Cleaning routinely is highly recommended! Tile cleaning is challenging, as we all know, but doing a thorough clean-up once a week could be helpful. Tiles may begin to accumulate dirt if they are not cleaned often. Before utilising any form of cleaning goods, it is imperative to remove any dust or dirt. Therefore, try regularly sweeping and mopping.</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Put doormats and rugs on your entryways to keep mud, grit, and filth out. The dirt our shoes pick up on the way home is the leading cause of filthy grout lines. Since the most dust is shed within, placing rugs is the key to keeping your tiles appearing brand new.</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Even though you regularly clean the tiles, there is still a danger that they could be harmed. Without a doubt, the floor tiles still require some maintenance and repair, even though they don´t require resurfacing or refinishing. So, pay attention to the tiles. Are they damaged, or maybe just cracked? If so, fix the tiles to prevent additional harm. The tile joint filler can be useful for correcting the problem if the damage is modest. Take the necessary activities or efforts to lessen the authenticity of the tiles, however, if the pain is severe. If necessary, have the tiles professionally inspected and cleaned at least once.</span></p><p><br></p>', 0, b'0', '2024-03-12 10:07:30', 1, NULL, NULL),
(5, '65f029a091b5e.jpg', 'blog-150522.jpg', 'Why Tiles Are The Perfect Flooring Choice According To Vastu?', 'Vastu Shastra for its embrace of all things eco', 2, '<p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Vastu Shastra, an ancient Indian practice of design, is said to be the basis of Feng Shui and has gained Western popularity for its eco-conscious appeal. When translated, “Vastu” means “the environment” and is about building homes that are in harmony with nature. As going green continues to grow in popularity so does Vastu Shastra for its embrace of all things eco.</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">The ancient practice that has been around for centuries may seem traditional and conservative but it’s actually quite the opposite. Vastu Shastra for home can be incorporated into modern designs to create a more positive and streamlined space that is more warm and welcoming.</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\"><img src=\"https://www.nitco.in/assets/nitco-images/blog/main/Nordic--fossil.jpg\"></span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Our homes are a reflection of who we are and when you follow the right Vastu tips for home you can further improve the conviviality of your space. A house becomes a home only when it radiates the right energy. According to a number of traditional beliefs, each home comes with its own energy type. The person dwelling in that house comes under the influence of this energy field, which in turn influences his/her life. This is why many believe that the right design, material and colours can help boost positive energy in the house.</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">When it comes to redoing our house or moving into a new space, we often take flooring to be a very minuscule part of the entire process. However, the right type of home floor tiles design can make a huge difference to the overall Vastu of the house.</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\"><img src=\"https://www.nitco.in/assets/nitco-images/blog/main/tli151spi0503.jpg\"></span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">While the below design approaches may sound familiar, it is better when we have an enlightened perspective, so here’s what you must know about the&nbsp;</span><a href=\"https://www.nitco.in/floor-tiles?utm_source=google&amp;utm_medium=website-blog&amp;utm_campaign=april-22&amp;utm_term=best-floor-tiles-for-home\" rel=\"noopener noreferrer\" target=\"_blank\" style=\"background-color: transparent; color: rgb(0, 0, 0);\">best floor tiles for home.</a></p><ol><li data-list=\"bullet\"><span class=\"ql-ui\" contenteditable=\"false\"></span><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Vastu Shastra for flooring suggests that the right colour, pattern, material and design of the flooring can help bring stability and harmony to the residents’ life.</span></li><li data-list=\"bullet\"><span class=\"ql-ui\" contenteditable=\"false\"></span><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">No matter what types of floor tiles you choose, the key element to remember is cleanliness. Decluttering and cleaning the floor keeps the mind free from toxic thoughts which makes us more receptive to positive energy.</span></li><li data-list=\"bullet\"><span class=\"ql-ui\" contenteditable=\"false\"></span><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Marble flooring is considered to be the best for flooring, especially in hues of white, as it brightens the space. Understanding the affordability and maintenance factor of real marble, it is best to use a tile that looks and feels like real marble but is easy to clean.</span></li></ol><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">The GVT Tru Life collection (above image belongs to a tile from the same collection) is a great way to replace real marble flooring without replacing the aesthetics of real marble. These tiles are much easier to clean and maintain than authentic marble.</span></p><ol><li data-list=\"bullet\"><span class=\"ql-ui\" contenteditable=\"false\"></span><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">To lend a softer feel to a room, opt for wooden flooring. It doesn’t dominate the space and at the same time brings in a lot of warmth. However, wooden flooring can be difficult to maintain, so opt for wooden-lookalike tiles that are made of clay and enhance the positivity of your interiors.</span></li></ol><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\"><img src=\"https://www.nitco.in/assets/nitco-images/blog/main/GPL058IBR1302.jpg\"></span></p><ol><li data-list=\"bullet\"><span class=\"ql-ui\" contenteditable=\"false\"></span><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Cracked floors near the entrance of the house or chipped flooring take away prosperity. Using tiles reduces the chances of this happening owing to their great resistance to load and abrasion. Even if damaged, tiles are more economical and easy to be replaced.</span></li></ol><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Keeping in mind the various aspects of Vastu, tiles are one of the best options for home flooring. Floor tiles are strong, stain-resistant and scratch-resistant. They are easy to clean and maintain making it possible for you to maintain cleanliness. Moreover, tiles offer you a range of choices in materials, colours, shapes and sizes. This makes it easier for you to incorporate Vastu into your home flooring. Health, happiness and prosperity are bound to follow when the right tiles are used as per Vastu principles.</span></p><p><br></p>', 0, b'0', '2024-03-12 10:08:32', 1, NULL, NULL),
(6, '65f02a08298f8.jpg', 'blog-3-march22.jpg', 'Here’s How You Can Add Warmth & Comfort To Your Bedroom', 'These five tips will help you find the warmth you craved in your bedrooms', 2, '<p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Our home is our sanctuary, and even within our homes, our bedrooms are some of the most private spaces where we can be ourselves. However, we must make our bedrooms cosy and secure. Whether we are investing in bedroom flooring or bedroom wall design, it must invoke a sense of peace, calm and relaxation. Often, we buy tiles that do not go with the décor of our bedroom. These five tips will help you find the warmth you craved in your bedrooms.</span></p><h2><strong style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Cosy tiles for cosy vibes</strong></h2><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\"><img src=\"https://www.nitco.in/nitcoassets/blog/main/Balsa-Sand-Dune.jpg\" alt=\"Cosy tiles\"></span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Bedroom wooden floor tiles are the perfect options to introduce a sense of warmth to your rooms. When we look at a tiling with a wooden finish, we imagine a fireplace with crackling wood logs, offering us the warmth we crave. NITCO’s&nbsp;</span><a href=\"https://www.nitco.in/product-details?bedroom-tiles&amp;colour=Beige&amp;product=balsa-sand-dune_ntTLL073WDL2104\" rel=\"noopener noreferrer\" target=\"_blank\" style=\"background-color: transparent; color: rgb(0, 0, 0);\">Balsa Sand Dune</a><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">&nbsp;is the perfect option as they are beautiful, but these bedroom 3D floor tiles are scratch-resistant, anti-skid, and offer chemical resistance.</span></p><h2><strong style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Plush Throws and Cushions for the ultimate comfort.</strong></h2><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\"><img src=\"https://www.nitco.in/nitcoassets/blog/main/blog-3-march22-1.jpg\" alt=\"comfort tiles\"></span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">When it comes to décor, plush throws across the bed and fluffy cushions are the go-to options. Make sure to introduce many colourful options as they will amplify the cosines levels in your bedroom and make it look more inviting. A plush throw, perhaps with a woolen knit fabric, will make things look more attractive and adorable. Introduce these items in your bedroom as they will go perfectly with your Balsa Sand Dune vitrified tiles.</span></p><h2><strong style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Rugs to compliment the floor</strong></h2><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\"><img src=\"https://www.nitco.in/nitcoassets/blog/main/blog-3-march22-bedroom-tiles.jpg\" alt=\"Rugs bedroom floor tiles\"></span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">We have the perfect bedroom floor tiles. However, these should be complemented with rugs. Rugs are a trendy décor option and are easy to take care of. These rugs will offer an extra cosiness to your bedroom and make things even softer and inviting. Rugs in different prints will only amplify the look of your bedroom, and with a modern bedroom wall design, the room will look even more fabulous.&nbsp;</span></p><h2><strong style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">An aesthetically pleasing yet comfy armchair</strong></h2><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\"><img src=\"https://www.nitco.in/nitcoassets/blog/main/blog-3-march22-2.jpg\" alt=\"comfy armchair\"></span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Sometimes we like to snuggle in a blanket and just sip a cup of hot chocolate and curl up with a book. A couch is perfect for such an occasion; it gives the bed some rest, but it offers an extra level of décor to your room that pulls everything together. This couch can be decorated with some throws and cushions, so make sure to splurge on those.</span></p><h2><strong style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">A cosy bed</strong></h2><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\"><img src=\"https://www.nitco.in/nitcoassets/blog/main/blog-3-march22-3.jpg\" alt=\"cosy bed\"></span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Make sure that your bed is cosy and has a bedding set that pleases your senses; a soft bed decorated with throws and cushions are inviting. Make sure to have some scented candles by your bed to make things even better. You will be lulled to sleep through your favourite fragrance with scented candles. Ensure that the mattress offers enough lumbar support and helps you with a night of uninterrupted sleep.</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Our bedrooms are our haven, and they must be decorated and well-kept. Avoid keeping any harsh or volatile items in your bedroom. Also, avoid anything that invokes negative vibes.</span></p><p><br></p>', 0, b'0', '2024-03-12 10:10:16', 1, NULL, NULL),
(7, '65f02a3e71db7.jpg', 'blog-2012021.jpg', 'How To Pick The Best Vitrified Tiles?', 'We give you five tips to help you in your purchase', 2, '<p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Vitrified tiles are one of the most popular types of tiles in the market and why not? They offer a variety of options from double charged vitrified tiles for heavy-traffic areas to polished vitrified tiles for an added elegance and glam. Moreover, they are affordable, resistant to scratches and stains, maintenance free and a perfect alternative to marble and granite.</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Since there are different types of&nbsp;</span><a href=\"https://www.nitco.in/vitrified-tiles\" rel=\"noopener noreferrer\" target=\"_blank\" style=\"background-color: transparent; color: rgb(0, 0, 0);\">vitrified tiles</a><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">&nbsp;available in the market, it is imperative to know how to pick the right ones for your space and lifestyle. We give you five tips to help you in your purchase.</span></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">1&nbsp;The quality of tiles</strong></p><p><a href=\"https://www.nitco.in/product-details?glazed-vitrified-tiles&amp;product=moon-cream_nttll202mgl0302\" rel=\"noopener noreferrer\" target=\"_blank\" style=\"color: rgb(0, 0, 0); background-color: transparent;\"><img src=\"https://www.nitco.in/nitcoassets/blog/main/The-quality-of-tiles.jpg\"></a></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">A thorough quality check should be done before buying the tiles. The vitrified floor tiles should be strong and shouldn’t be cracked or chipped. Before you make a final decision about your flooring or wall tiles, it is best to visit the store and have a detailed look at your batch.</span></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">2&nbsp;Check technical specifications</strong></p><p><a href=\"https://www.nitco.in/product-details?glazed-vitrified-tiles&amp;product=nero-dorato_nttll202mgd1002\" rel=\"noopener noreferrer\" target=\"_blank\" style=\"color: rgb(0, 0, 0); background-color: transparent;\"><img src=\"https://www.nitco.in/nitcoassets/blog/main/Check-technical-specifications.jpg\"></a></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Vitrified tiles are dense and hence, non-porous. It is important to check that the tiles do not absorb more than 0.1% of water by weight of the tile. Tiles with less water absorption are stronger and more durable. Therefore, the technical specifications of the tile should be checked thoroughly well before purchasing.</span></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">3&nbsp;Select the preferred size of tiles</strong></p><p><a href=\"https://www.nitco.in/product-details?glazed-vitrified-tiles&amp;product=classic-dyna_nttll202mgl0802\" rel=\"noopener noreferrer\" target=\"_blank\" style=\"color: rgb(0, 0, 0); background-color: transparent;\"><img src=\"https://www.nitco.in/nitcoassets/blog/main/Select-the-preferred-size-of-tiles.jpg\"></a></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Oversized tiles are making a huge noise owing to their aesthetic appeal and their ability to make your space look bigger. Cleaning of bigger tiles can be managed faster as there are fewer joints that are visible. A double-whammy for sure! This is why 600x1200mm sized tiles are currently in demand in the market.</span></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">4&nbsp;Calculate the quantity of tiles</strong></p><p><a href=\"https://www.nitco.in/product-details?glazed-vitrified-tiles&amp;product=piena-masa-graphite_nttli203spi0201\" rel=\"noopener noreferrer\" target=\"_blank\" style=\"color: rgb(0, 0, 0); background-color: transparent;\"><img src=\"https://www.nitco.in/nitcoassets/blog/main/Calculate-the-quantity-of-tiles.jpg\"></a></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Make sure to calculate the quantity of tiles you require before you go for tile shopping. Buy at least 5-10% extra tiles, which will take care of any wastage caused during cutting and installation.</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Whether you are looking at vitrified wall tiles or&nbsp;</span><a href=\"https://www.nitco.in/vitrified-tiles\" rel=\"noopener noreferrer\" target=\"_blank\" style=\"background-color: transparent; color: rgb(0, 0, 0);\">vitrified floor tiles</a><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">, NITCO offers a range of options for you to pick from. When it comes to tile selection, our experts can help you pick the right tiles for your space, and you don’t have to worry about the rest. With NITCO’s cutting-edge technology, there is minimal wastage which brings down the overall cost and the hassle of buying extra.</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Explore the wide range of vitrified tiles at any of your&nbsp;</span><a href=\"https://www.nitco.in/stores\" rel=\"noopener noreferrer\" target=\"_blank\" style=\"background-color: transparent; color: rgb(0, 0, 0);\">nearest NITCO tiles store</a><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">&nbsp;or have a look at our</span><a href=\"https://www.instagram.com/nitcoltd/\" rel=\"noopener noreferrer\" target=\"_blank\" style=\"background-color: transparent; color: rgb(0, 0, 0);\">&nbsp;Instagram profile</a><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">&nbsp;to get an idea about the collection.&nbsp;</span></p><p><br></p>', 0, b'0', '2024-03-12 10:11:10', 1, NULL, NULL),
(8, '65f02a7e1c4c2.jpg', 'blog-207021.jpg', 'How To Make Your Bedroom A Calming Sanctuary?', 'We have for you some innovative ways to upgrade the bathroom without a lot of hassle', 2, '<p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">The bathroom of your house is a very important space. It is where you start and end your days. It’s a room where you are absolute real self and that relationship with yourself definitely deserves a special space. If you are looking to renovate your bathroom or give your bathroom a makeover, we have for you some innovative ways to upgrade the bathroom without a lot of hassle.</span></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Light up the space</strong></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\"><img src=\"https://www.nitco.in/nitcoassets/blog/main/light-up-the-space.jpg\"></strong></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">The biggest change that you can possibly bring to your bathroom is the lighting scheme and your&nbsp;</span><a href=\"https://www.nitco.in/bathroom-tiles\" rel=\"noopener noreferrer\" target=\"_blank\" style=\"background-color: transparent; color: rgb(0, 0, 0);\">bathroom tiles</a><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">. Ideally, most rooms feature these: natural light, functional light and ambient light. All of this works differently and plays with your moods. Applying makeup with accuracy and relaxing in a bathtub, both require different kinds of light. Natural light is something that you can achieve only when you are completely renovating your space, however, if you are only looking at a small upgrade, try and add recessed lights above the shower or bath and the toilet.</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Bathroom floor tiles or bathroom wall tiles are a personal choice but ensure you use non-slip bathroom floor tiles to avoid any fall.</span></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">A clutter-free space</strong></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\"><img src=\"https://www.nitco.in/nitcoassets/blog/main/a-clutter-free-space.jpg\"></strong></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Often, bathrooms are left in a mess owing to our busy lifestyle and our hurried mornings. However, a clutter-free bathroom will make a whole lot of difference and will help you unwind in the best possible way when you are ending your day. A cluttered sink can feel claustrophobic so let your countertops breathe. For an easy way to do this, get a nice tray and stack your essentials on it with a candle. Lesser the clutter, easier it gets to clean your bathroom flooring.</span></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Plush accessories, For The Win</strong></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\"><img src=\"https://www.nitco.in/nitcoassets/blog/main/plush-accessories.jpg\"></strong></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Want to give your bathroom an instant face lift? Invest in some nice towels, vases and cane baskets. Get good quality hand towels, candles and soaps to feel extra luxurious. Even if all this sounds a little too extra, we bet you will feel the change and fall in love with it. Believe us, these small external changes can help make internal shifts too. If you are looking for bigger changes then consider installing designer bathroom tiles or&nbsp;</span><a href=\"https://www.nitco.in/bathroom-tiles\" rel=\"noopener noreferrer\" target=\"_blank\" style=\"background-color: transparent; color: rgb(0, 0, 0);\">luxury bathroom tiles</a><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">.&nbsp;</span></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">A sophisticated shelving unit</strong></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\"><img src=\"https://www.nitco.in/nitcoassets/blog/main/a-sophisticated-shelving-unit.jpg\"></strong></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Most of us have a whole lot of vanity that we store in the bathroom. If you relate to this and are looking at how to make your bathroom clutter-free, invest in a good-looking shelving unit that goes well with your bathroom interiors. Drawer organizers are critical in this case. Likewise, baskets are great for cabinets and small jars and tins can be used for your knick-knacks.</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Now you have a bathroom where you might turn that routine into a refreshing morning ritual that starts off every day with an intention!</span></p><p><br></p>', 2, b'0', '2024-03-12 10:12:14', 1, NULL, NULL),
(9, '65f02b84e99fa.jpg', 'blog-0609021.jpg', '4 Ways To Upgrade Your Current Bathroom', 'We have for you some innovative ways to upgrade the bathroom without a lot of hassle', 2, '<p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">The bathroom of your house is a very important space. It is where you start and end your days. It’s a room where you are absolute real self and that relationship with yourself definitely deserves a special space. If you are looking to renovate your bathroom or give your bathroom a makeover, we have for you some innovative ways to upgrade the bathroom without a lot of hassle.</span></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Light up the space</strong></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\"><img src=\"https://www.nitco.in/nitcoassets/blog/main/light-up-the-space.jpg\"></strong></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">The biggest change that you can possibly bring to your bathroom is the lighting scheme and your&nbsp;</span><a href=\"https://www.nitco.in/bathroom-tiles\" rel=\"noopener noreferrer\" target=\"_blank\" style=\"background-color: transparent; color: rgb(0, 0, 0);\">bathroom tiles</a><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">. Ideally, most rooms feature these: natural light, functional light and ambient light. All of this works differently and plays with your moods. Applying makeup with accuracy and relaxing in a bathtub, both require different kinds of light. Natural light is something that you can achieve only when you are completely renovating your space, however, if you are only looking at a small upgrade, try and add recessed lights above the shower or bath and the toilet.</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Bathroom floor tiles or bathroom wall tiles are a personal choice but ensure you use non-slip bathroom floor tiles to avoid any fall.</span></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">A clutter-free space</strong></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\"><img src=\"https://www.nitco.in/nitcoassets/blog/main/a-clutter-free-space.jpg\"></strong></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Often, bathrooms are left in a mess owing to our busy lifestyle and our hurried mornings. However, a clutter-free bathroom will make a whole lot of difference and will help you unwind in the best possible way when you are ending your day. A cluttered sink can feel claustrophobic so let your countertops breathe. For an easy way to do this, get a nice tray and stack your essentials on it with a candle. Lesser the clutter, easier it gets to clean your bathroom flooring.</span></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Plush accessories, For The Win</strong></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\"><img src=\"https://www.nitco.in/nitcoassets/blog/main/plush-accessories.jpg\"></strong></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Want to give your bathroom an instant face lift? Invest in some nice towels, vases and cane baskets. Get good quality hand towels, candles and soaps to feel extra luxurious. Even if all this sounds a little too extra, we bet you will feel the change and fall in love with it. Believe us, these small external changes can help make internal shifts too. If you are looking for bigger changes then consider installing designer bathroom tiles or&nbsp;</span><a href=\"https://www.nitco.in/bathroom-tiles\" rel=\"noopener noreferrer\" target=\"_blank\" style=\"background-color: transparent; color: rgb(0, 0, 0);\">luxury bathroom tiles</a><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">.&nbsp;</span></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">A sophisticated shelving unit</strong></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\"><img src=\"https://www.nitco.in/nitcoassets/blog/main/a-sophisticated-shelving-unit.jpg\"></strong></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Most of us have a whole lot of vanity that we store in the bathroom. If you relate to this and are looking at how to make your bathroom clutter-free, invest in a good-looking shelving unit that goes well with your bathroom interiors. Drawer organizers are critical in this case. Likewise, baskets are great for cabinets and small jars and tins can be used for your knick-knacks.</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Now you have a bathroom where you might turn that routine into a refreshing morning ritual that starts off every day with an intention!</span></p><p><br></p>', 0, b'0', '2024-03-12 10:13:12', 1, '2024-03-12 10:16:36', 1);
INSERT INTO `blog_article` (`id`, `coverimage`, `originalcoverimage`, `name`, `description`, `blogcategoryid`, `content`, `viewcount`, `deleted`, `createdat`, `createdby`, `lastmodifiedat`, `lastmodifiedby`) VALUES
(10, '65f02b029e9f4.jpg', 'blog-502021.jpg', '5 Interior Styles We Will Be Seeing More Of In 2024', 'We unveil 5 interior styles that are going to be big this year', 1, '<p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Interior styles and décor have seen a drastic change in 2024 with work from home being the new normal. If you are late to the party and still aren’t aware of&nbsp;</span><a href=\"https://www.nitco.in/blog-details?how-to-setup-the-perfect-work-from-home-space-within-your-budget-_26\" rel=\"noopener noreferrer\" target=\"_blank\" style=\"background-color: transparent; color: rgb(0, 0, 0);\">how to setup a work-from-home space in a budget</a><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">, we’ve got you covered. So, if you are looking at revamping your space and are still researching 2024 trends, this read is for you. We unveil 5 interior styles that are going to be big this year.</span></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Japandi:</strong></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Japandi is described as Japanese minimalism meets Danish ‘hygge’. Comforting colours and textures that include a touch of Japanese interior design come together. With staying at home and a yearning of calm being the prime focus, this design is perfect for those looking at classics. NITCO’s&nbsp;</span><a href=\"https://www.nitco.in/product-details?ceramic-floor-tiles&amp;product=moonstone-graphite_ntcfl033cmx2204\" rel=\"noopener noreferrer\" target=\"_blank\" style=\"background-color: transparent; color: rgb(0, 0, 0);\">Moonstone Graphite&nbsp;ceramic floor tiles</a><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">&nbsp;fit well with the Japandi aesthetics and are the true definition of minimalism.&nbsp;</span></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Maximalism</strong></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Maximalism is all about filling your space with things you love…all the things you love. Some may find it OTT but fans of this trend think otherwise. Of course, it isn’t about making the space look congested but it\'s more to do with gathering your most loved pieces and placing them together. The&nbsp;</span><a href=\"https://www.nitco.in/product-details?glazed-vitrified-tiles&amp;product=upasana-vit-decor_nttln033grd2304\" rel=\"noopener noreferrer\" target=\"_blank\" style=\"background-color: transparent; color: rgb(0, 0, 0);\">Upasana Vit&nbsp;Décor tiles</a><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">&nbsp;are great interior tiles that offer aesthetic as well as elegance to a space.</span></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Warm Colours</strong></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Our growing need to stay in touch with Mother Nature’s warm tones leads us to this trend. Shades that spread warmth and are inspired by nature are an all-time favourite. The burnt orange colour of the&nbsp;</span><a href=\"https://www.nitco.in/product-details?ceramic-wall-tiles&amp;product=lunar-breccia_ntwtl018cds13106\" rel=\"noopener noreferrer\" target=\"_blank\" style=\"background-color: transparent; color: rgb(0, 0, 0);\">Lunar Breccia</a><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">&nbsp;make them the ideal ceramic wall tiles for your bathrooms.</span></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Bold Florals</strong></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Bold floral designs are making a comeback and are often featured in home décor magazines and insta-worthy homes. This trend can be played around with in several ways and can be introduced in your homes in more than one way. Seen here is NITCO’s&nbsp;</span><a href=\"https://www.nitco.in/product-details?ceramic-wall-tiles&amp;product=sakura-decor_ntwtl032hll13005\" rel=\"noopener noreferrer\" target=\"_blank\" style=\"background-color: transparent; color: rgb(0, 0, 0);\">Sakura décor wall tiles</a><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">&nbsp;that create a magnificent hero wall in a living room.</span></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Shabby Chic</strong></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">This enormously popular trend is making a comeback but with a little twist. Think more of natural textures like wood and more use of recycled pieces rather than new items made to look old. NITCO’s&nbsp;</span><a href=\"https://www.nitco.in/product-details?ceramic-floor-tiles&amp;product=woodblock-natural_ntcfl033cmx1004\" rel=\"noopener noreferrer\" target=\"_blank\" style=\"background-color: transparent; color: rgb(0, 0, 0);\">Woodblock Natural&nbsp;ceramic tiles</a><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">&nbsp;fit perfectly well with this trend and look drop dead gorgeous.</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Which of these interior styles are you most likely to adopt in your space?</span></p><ol><li data-list=\"bullet\"><span class=\"ql-ui\" contenteditable=\"false\"></span><br></li></ol><p><br></p>', 0, b'0', '2024-03-12 10:14:26', 1, NULL, NULL),
(11, '65f02b9901fcc.jpg', 'blog-281120.jpg', 'Why The Made In Italy Collection Deserves A Place In Your New Space', 'The range of these Made in Italy tiles and their features', 1, '<p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\"><img src=\"https://www.nitco.in/nitcoassets/blog/main/boutique.jpg\" alt=\"Description: A room filled with furniture and vase of flowers on a tableDescription automatically generated\"></span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">A boutique collection by NITCO tiles, the Made in Italy Collection is specially curated for those with an eye for design. Made in Faenza, Italy, the cradle of ceramics and the land known for its expansive structures, the Made in Italy&nbsp;collection is nothing short of luxury. The tiles are porcelain stone with an astonishing range of sizes, thicknesses, and colours to uplift any surface – wall or floor, indoor or outdoor, residential or commercial spaces.&nbsp;</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Here’s all you need to know about the range of these Made in Italy tiles and their features:</span></p><h2><strong style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">1. Concrete Abstract</strong></h2><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">There are eight colours that interpret cement and coloured resins in a modern way. This range allows you to explore bright and bold shades, both in residential and commercial projects. This is possible thanks to the high technical characteristics provided by the unglazed porcelain tiles.</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\"><img src=\"https://www.nitco.in/nitcoassets/blog/main/Concrete-Abstract.jpg\" alt=\"Description: A bedroom with a bed and a chair in a roomDescription automatically generated\"></span></p><h2><strong style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">2. Moda Esclusivo</strong></h2><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Who said minimalism is restricted to black and white? Broaden your horizon with Azul. A loyal minimalist would know that minimalism is more about natural and neutral shades that adapt to the different needs of living. This helps you maintain the base colour continuity along with exploring various colour tone expressions.</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Features:</span></p><ol><li data-list=\"bullet\"><span class=\"ql-ui\" contenteditable=\"false\"></span><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Material is durable, stable, hygienic, and safe.</span></li><li data-list=\"bullet\"><span class=\"ql-ui\" contenteditable=\"false\"></span><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">The effect is light, discreet, delicately decorated with a textured surface or neutral and straightforward with a smooth surface.</span></li></ol><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\"><img src=\"https://www.nitco.in/nitcoassets/blog/main/Moda-Esclusivo.jpg\" alt=\"Description: A dining room tableDescription automatically generated\"></span></p><h2><strong style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">3. Pienna Massa Graphite</strong></h2><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">This is a flexible ceramic system that can be adapted with chromatic coherence for various architectural applications. For example, the same colour can be used in an access floor with a concrete effect, on walls with a polished effect, in external areas with an anti-slip bush hammered surface, and for kitchen &amp; vanity tops in backsplashes.</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\"><img src=\"https://www.nitco.in/nitcoassets/blog/main/Pienna-Massa-Graphite.jpg\" alt=\"Description: A picture containing indoor, sitting, room, tableDescription automatically generated\"></span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">If you are still confused about the beauty of these tiles, here are a few benefits that will make you sure about them.</span></p><ol><li data-list=\"bullet\"><span class=\"ql-ui\" contenteditable=\"false\"></span><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">They are thin and light-weight to carry around.</span></li><li data-list=\"bullet\"><span class=\"ql-ui\" contenteditable=\"false\"></span><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Fire-proof, environment friendly, and frost-proof.</span></li><li data-list=\"bullet\"><span class=\"ql-ui\" contenteditable=\"false\"></span><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Ideal for interior and exterior cladding.</span></li><li data-list=\"bullet\"><span class=\"ql-ui\" contenteditable=\"false\"></span><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Sanitize as many times as you want. The Porcelain Italian tiles are subject to specific tests that make them resistant to various sanitizing agents.</span></li></ol><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Amp up your space with these beautiful, high-quality porcelain stoneware slabs, and we bet your house will be the centre of attention for its magnificent makeover.&nbsp;&nbsp;</span></p><p><br></p>', 1, b'0', '2024-03-12 10:15:46', 1, '2024-03-12 10:16:56', 1),
(12, '65f02bf54c83e.jpg', 'travertino-titanium.jpg', 'Bringing Neutrals Back In Vogue', 'Elegant trend of this year', 1, '<p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">We often take tiles, whether for floors or walls, for granted. While revamping our office or home, we often think about the paint colour, the theme, the furniture but seldom do we think of tiles and the new tile trends that have hit the market. NITCO is an expert for all your tiling woes, from floor tiles to wall tiles, and has an exhaustive collection of trending tiles’ designs. If 2021 has taught us anything, it is all about staying calm, relaxed and patient while staying safe indoors. The tile trend for this year somewhat vibes with this very thought. Neutrals are known to calm your mind so that you can redirect your negative thoughts into affirmations. Let’s deep dive into this relaxed yet elegant trend of this year – neutral colour tiles.</span></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Warm Neutrals</strong></p><p><a href=\"https://www.nitco.in/product-details?glazed-vitrified-tiles&amp;product=travertino-titanium_nttll033mpl5604\" rel=\"noopener noreferrer\" target=\"_blank\" style=\"color: rgb(0, 0, 0); background-color: transparent;\"><img src=\"https://www.nitco.in/nitcoassets/blog/main/travertino-titanium.jpg\"></a></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">We cannot say no to beautiful ivory that can uplift our mood at any hour of the day. A shade that makes its way directly to your heart, this ivory-coloured tile is here to stay. The&nbsp;</span><a href=\"https://www.nitco.in/product-details?glazed-vitrified-tiles&amp;product=travertino-titanium_nttll033mpl5604\" rel=\"noopener noreferrer\" target=\"_blank\" style=\"background-color: transparent; color: rgb(0, 0, 0);\">Travertino Titanium</a><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">&nbsp;is a marble effect glazed vitrified tile that can make your walls and floors look stylish and sophisticated.</span></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Neutral Greens</strong></p><p><a href=\"https://www.nitco.in/product-details?wall-tiles&amp;colour=Green&amp;product=botanique-lt_ntwtl032udl19705\" rel=\"noopener noreferrer\" target=\"_blank\" style=\"color: rgb(0, 0, 0); background-color: transparent;\"><img src=\"https://www.nitco.in/nitcoassets/blog/main/botanique-lt.jpg\"></a></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">While talking about neutrals, we often restrict ourselves to the basics. However, with a range of options available at NITCO, you can add some pizzazz to your everyday neutrals too. The&nbsp;</span><a href=\"https://www.nitco.in/product-details?wall-tiles&amp;colour=Green&amp;product=botanique-lt_ntwtl032udl19705\" rel=\"noopener noreferrer\" target=\"_blank\" style=\"background-color: transparent; color: rgb(0, 0, 0);\">Botanique LT</a><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">&nbsp;is a beautiful green coloured ceramic wall tile that helps bring in some nature to your home.</span></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Bring That Beige Back</strong></p><p><a href=\"https://www.nitco.in/product-details?glazed-vitrified-tiles&amp;product=travertino-cream_nttll033mpl5504\" rel=\"noopener noreferrer\" target=\"_blank\" style=\"color: rgb(0, 0, 0); background-color: transparent;\"><img src=\"https://www.nitco.in/nitcoassets/blog/main/travertino-cream.jpg\"></a></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">If you don’t like to experiment much and want to go with the normal, opt for neutral colour floor tiles and pick a beige colour tile or cream-coloured tile. Beige is a timeless shade that will never put you off and keep you relaxed. The&nbsp;</span><a href=\"https://www.nitco.in/product-details?glazed-vitrified-tiles&amp;product=travertino-cream_nttll033mpl5504\" rel=\"noopener noreferrer\" target=\"_blank\" style=\"background-color: transparent; color: rgb(0, 0, 0);\">Travertino Cream</a><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">&nbsp;by NITCO is a cream floor tile that has a marble effect. We bet you will fall in love with its shine and elegance.</span></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Wood Looks</strong></p><p><a href=\"https://www.nitco.in/product-details?woodville-collections-tiles&amp;title=woodville&amp;product=wd-maple-miel_nttll073wdl0804\" rel=\"noopener noreferrer\" target=\"_blank\" style=\"color: rgb(0, 0, 0); background-color: transparent;\"><img src=\"https://www.nitco.in/nitcoassets/blog/main/WD-Maple-Miel.jpg\"></a></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Perfect for flooring and walls, wooden effect tiles bring in the rustic and raw vibe that you often miss at home if you love the outdoors. If you don’t wish to go for the regular white, beige and brown and, at the same time, don’t want to opt for something too different – then wood lookalike tiles are the best option. NITCO’s&nbsp;</span><a href=\"https://www.nitco.in/product-details?woodville-collections-tiles&amp;title=woodville&amp;product=wd-maple-miel_nttll073wdl0804\" rel=\"noopener noreferrer\" target=\"_blank\" style=\"background-color: transparent; color: rgb(0, 0, 0);\">WD Maple Miel</a><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">&nbsp;from the Woodville collection is one of the best shades of wood that would go well with all furniture.</span></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Pristine White</strong></p><p><a href=\"https://www.nitco.in/product-details?glazed-vitrified-tiles&amp;product=lasa-bianco_nttll058msw0302\" rel=\"noopener noreferrer\" target=\"_blank\" style=\"color: rgb(0, 0, 0); background-color: transparent;\"><img src=\"https://www.nitco.in/nitcoassets/blog/main/lasa-bianco.jpg\"></a></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">White is the most elegant colour that one can think of when doing up their floors or walls. NITCO’s&nbsp;</span><a href=\"https://www.nitco.in/product-details?glazed-vitrified-tiles&amp;product=lasa-bianco_nttll058msw0302\" rel=\"noopener noreferrer\" target=\"_blank\" style=\"background-color: transparent; color: rgb(0, 0, 0);\">Lasa Bianco</a><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">&nbsp;tile is a glossy marble effect tile with beautiful grey veins and can easily charm you with its neutral yet extraordinary shade. Moreover,&nbsp;</span><a href=\"https://www.nitco.in/floor-tiles&amp;colour=White\" rel=\"noopener noreferrer\" target=\"_blank\" style=\"background-color: transparent; color: rgb(0, 0, 0);\">white floor tiles</a><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">&nbsp;are timeless and add a touch of glam to every space.</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">If you are revamping a small space in your house or office and are thinking of the many options available, you can get in touch with our experts who can guide you on which tile is best for your use.</span></p><p><br></p>', 0, b'0', '2024-03-12 10:18:29', 1, NULL, NULL),
(13, '65f02c62d1f5a.jpg', 'blog-151021.jpg', 'The Mosaic Range You Need To Be Excited About', 'Here are some mosaic design ideas by NITCO', 2, '<p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">If you are looking at adding versatility and freshening up the interiors of your home, mosaic tiles offer a creative touch like no other. The different colours, patterns and the vibrancy they bring in make mosaic flooring and mosaic wall tiles, the most sought-after to use for a stunning effect. If you are looking for an alternative to conventional wall and floor tiles, mosaic is your way to go. Here are some mosaic design ideas by NITCO that look absolutely gorgeous.</span></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">KISS – Keep It Simple &amp; Subtle</strong></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\"><img src=\"https://www.nitco.in/nitcoassets/blog/main/Rigel.jpg\"></span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">If you are someone who cannot relate to glamorous and eye-grabbing colours and find refuge in simple and subtle hues, you are going to love the&nbsp;</span><a href=\"https://www.nitco.in/mosaico-product-details?mosaico&amp;product=Mosaico_ntms017walm03707\" rel=\"noopener noreferrer\" target=\"_blank\" style=\"background-color: transparent; color: rgb(0, 0, 0);\">Rigel&nbsp;mosaic floor tiles</a><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">. The beige and brown combination looks rustic and exudes an elegant vibe that will go well with most of your aesthetics.</span></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Beige &amp; Beautiful</strong></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\"><img src=\"https://www.nitco.in/nitcoassets/blog/main/Lattice-Beige.jpg\"></strong></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">Love an intriguing eye illusion? Trust NITCO’s&nbsp;</span><a href=\"https://www.nitco.in/mosaico-product-details?mosaico&amp;product=Mosaico_ntms017wals03307\" rel=\"noopener noreferrer\" target=\"_blank\" style=\"background-color: transparent; color: rgb(0, 0, 0);\">Lattice Beige mosaic tiles</a><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">&nbsp;to lend the perfect mosaic frame for your outdoors and make an impression on anyone who sets foot in your space. Just a sliver of these mosaic tiles can seal the deal too as they can instantly uplift the entire area with their eye-grabbing placement.</span></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">White Elegance</strong></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\"><img src=\"https://www.nitco.in/nitcoassets/blog/main/White-Elegance.jpg\"></span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">The&nbsp;</span><a href=\"https://www.nitco.in/mosaico-product-details?mosaico&amp;product=Mosaico_ntms156walp04520\" rel=\"noopener noreferrer\" target=\"_blank\" style=\"background-color: transparent; color: rgb(0, 0, 0);\">Nuvola White mosaic tiles</a><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">&nbsp;are the most popular mosaic kitchen tiles owing to their ability to create an impact as a backsplash. They are easily the hero of the kitchen décor and can help make an impression without trying too hard. They transform the look of your cooking area and are easy to maintain as mosaic tiles are easy to clean. You simply have to wipe them with a wet cloth and the stains will vanish.</span></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">The Ultimate Classic</strong></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\"><img src=\"https://www.nitco.in/nitcoassets/blog/main/odessi-black.jpg\">&nbsp;</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">No one can say no to a great combination of black and white. Perfect for your home flooring makeover, the Odessi Black mosaic tiles should be your go-to if you want to get a little creative and whacky with your interiors. Mosaic floor tiles are highly durable and are resistant to chemicals which is why using them as your flooring material would be a great choice.</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">NITCO has a wide range of&nbsp;</span><a href=\"https://www.nitco.in/mosaico\" rel=\"noopener noreferrer\" target=\"_blank\" style=\"background-color: transparent; color: rgb(0, 0, 0);\">mosaic&nbsp;tiles collection</a><span style=\"background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);\">&nbsp;to choose from and let’s accept it, in the endless possibilities in home décor, mosaic takes a special place with its vibrant and fun flair.</span></p><p><br></p>', 0, b'0', '2024-03-12 10:20:18', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `blog_category`
--

CREATE TABLE `blog_category` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `remark` varchar(500) DEFAULT NULL,
  `deleted` bit(1) NOT NULL DEFAULT b'0',
  `createdby` int(11) DEFAULT NULL,
  `createdat` datetime DEFAULT NULL,
  `lastmodifiedby` int(11) DEFAULT NULL,
  `lastmodifiedat` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blog_category`
--

INSERT INTO `blog_category` (`id`, `name`, `remark`, `deleted`, `createdby`, `createdat`, `lastmodifiedby`, `lastmodifiedat`) VALUES
(1, 'Tiles Trend', NULL, b'0', 1, '2024-03-12 10:00:05', NULL, NULL),
(2, 'Tips', NULL, b'0', 1, '2024-03-12 10:00:18', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `blog_comment`
--

CREATE TABLE `blog_comment` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `commentcontent` varchar(1000) NOT NULL,
  `blogarticleid` int(11) NOT NULL,
  `status` bit(1) NOT NULL DEFAULT b'0',
  `deleted` bit(1) NOT NULL DEFAULT b'0',
  `createdby` int(11) DEFAULT NULL,
  `createdat` datetime DEFAULT NULL,
  `lastmodifiedby` int(11) DEFAULT NULL,
  `lastmodifiedat` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blog_comment`
--

INSERT INTO `blog_comment` (`id`, `userid`, `commentcontent`, `blogarticleid`, `status`, `deleted`, `createdby`, `createdat`, `lastmodifiedby`, `lastmodifiedat`) VALUES
(1, 3, 'Good!', 1, b'1', b'1', 3, '2024-03-14 07:40:53', 1, '2024-03-14 07:41:31'),
(2, 2, 'Test Comment', 1, b'0', b'0', 2, '2024-03-17 04:28:08', NULL, NULL),
(3, 2, 'test', 1, b'1', b'0', 2, '2024-03-19 11:15:54', 1, '2024-03-19 11:16:24');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `remark` varchar(500) DEFAULT NULL,
  `deleted` bit(1) NOT NULL DEFAULT b'0',
  `createdby` int(11) DEFAULT NULL,
  `createdat` datetime DEFAULT NULL,
  `lastmodifiedby` int(11) DEFAULT NULL,
  `lastmodifiedat` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `remark`, `deleted`, `createdby`, `createdat`, `lastmodifiedby`, `lastmodifiedat`) VALUES
(1, 'Wall Tiles', NULL, b'0', 5, '2024-03-10 03:19:45', 1, '2024-03-19 07:13:57'),
(2, 'Floor Tiles', NULL, b'0', 5, '2024-03-10 04:30:47', NULL, NULL),
(3, 'Special Tiles', NULL, b'0', 5, '2024-03-10 04:31:22', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category_sub`
--

CREATE TABLE `category_sub` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `remark` varchar(500) DEFAULT NULL,
  `categoryid` int(11) NOT NULL,
  `deleted` bit(1) DEFAULT b'0',
  `createdby` int(11) DEFAULT NULL,
  `createdat` datetime DEFAULT NULL,
  `lastmodifiedby` int(11) DEFAULT NULL,
  `lastmodifiedat` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category_sub`
--

INSERT INTO `category_sub` (`id`, `name`, `remark`, `categoryid`, `deleted`, `createdby`, `createdat`, `lastmodifiedby`, `lastmodifiedat`) VALUES
(1, 'Bathroom wall tiles', NULL, 1, b'0', 5, '2024-03-10 04:59:47', NULL, NULL),
(2, 'Kitchen wall tiles', NULL, 1, b'0', 5, '2024-03-10 05:05:00', NULL, NULL),
(3, 'Outdoor wall tiles', NULL, 1, b'0', 5, '2024-03-10 05:05:10', NULL, NULL),
(4, 'Living room', NULL, 1, b'0', 5, '2024-03-10 05:05:37', NULL, NULL),
(5, 'Bedroom', NULL, 1, b'0', 5, '2024-03-10 05:05:48', NULL, NULL),
(6, 'Commercial spaces tiles', NULL, 1, b'0', 5, '2024-03-10 05:05:58', NULL, NULL),
(7, 'Bathroom floor tiles', NULL, 2, b'0', 5, '2024-03-10 05:06:09', NULL, NULL),
(8, 'Kitchen floor tiles', NULL, 2, b'0', 5, '2024-03-10 05:06:27', NULL, NULL),
(9, 'Outdoor floor tiles', NULL, 2, b'0', 5, '2024-03-10 05:17:42', NULL, NULL),
(10, 'Living room', NULL, 2, b'0', 5, '2024-03-10 05:17:51', 1, '2024-03-19 07:24:53'),
(11, 'Bedroom', NULL, 2, b'0', 5, '2024-03-10 05:18:01', NULL, NULL),
(12, 'Commercial spaces tiles', NULL, 2, b'0', 5, '2024-03-10 05:18:12', NULL, NULL),
(13, 'Germ free', NULL, 3, b'0', 5, '2024-03-10 05:18:30', NULL, NULL),
(14, 'Tac', NULL, 3, b'0', 5, '2024-03-10 05:18:38', NULL, NULL),
(15, 'Anti static', NULL, 3, b'0', 5, '2024-03-10 05:18:52', NULL, NULL),
(16, 'Cool roof', NULL, 3, b'0', 5, '2024-03-10 05:19:31', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `companyinfo`
--

CREATE TABLE `companyinfo` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `address` varchar(250) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `fax` varchar(100) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `longitude` varchar(50) DEFAULT NULL,
  `latitude` varchar(50) DEFAULT NULL,
  `embedmapurl` varchar(1000) DEFAULT NULL,
  `createdby` int(11) DEFAULT NULL,
  `createdat` datetime DEFAULT NULL,
  `lastmodifiedby` int(11) DEFAULT NULL,
  `lastmodifiedat` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `companyinfo`
--

INSERT INTO `companyinfo` (`id`, `name`, `address`, `phone`, `fax`, `email`, `longitude`, `latitude`, `embedmapurl`, `createdby`, `createdat`, `lastmodifiedby`, `lastmodifiedat`) VALUES
(1, 'Cera Tiles Company Ltd.', '53 Smith Rd, Middletown, NY 10941, USA', '7181-299-5301', '7128-218-8012', 'ceracompany.public@gmail.com', NULL, NULL, 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2990.2373961629933!2d-74.36939302259074!3d41.4557661712914!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c260d066d843d5%3A0xf0ea195290fe3d6b!2sCera%20Tile!5e0!3m2!1svi!2s!4v1709090930366!5m2!1svi!2s', 5, '2024-02-28 02:59:26', 5, '2024-02-28 14:50:03');

-- --------------------------------------------------------

--
-- Table structure for table `contactrequest`
--

CREATE TABLE `contactrequest` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `contactback` bit(1) NOT NULL DEFAULT b'0',
  `deleted` bit(1) NOT NULL DEFAULT b'0',
  `createdat` datetime DEFAULT NULL,
  `lastmodifiedby` int(11) DEFAULT NULL,
  `lastmodifiedat` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contactrequest`
--

INSERT INTO `contactrequest` (`id`, `name`, `email`, `message`, `contactback`, `deleted`, `createdat`, `lastmodifiedby`, `lastmodifiedat`) VALUES
(1, 'Huyen', 'huyen12121212@gmail.com', 'Test contact me', b'0', b'0', '2024-03-17 04:29:18', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `deliveryfee`
--

CREATE TABLE `deliveryfee` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `cost` float UNSIGNED NOT NULL,
  `remark` varchar(500) DEFAULT NULL,
  `deleted` bit(1) NOT NULL DEFAULT b'0',
  `createdat` datetime DEFAULT NULL,
  `createdby` int(11) DEFAULT NULL,
  `lastmodifiedat` datetime DEFAULT NULL,
  `lastmodifiedby` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deliveryfee`
--

INSERT INTO `deliveryfee` (`id`, `name`, `cost`, `remark`, `deleted`, `createdat`, `createdby`, `lastmodifiedat`, `lastmodifiedby`) VALUES
(1, 'Pickup by myself', 0, NULL, b'0', '2024-03-03 12:45:15', 1, '2024-03-03 12:45:24', 1),
(2, 'Los Angeles, CA', 12.8, NULL, b'0', '2024-03-03 12:45:20', 1, '2024-03-05 15:16:54', 5),
(3, 'Chicago, IL', 30, NULL, b'1', '2024-03-03 12:45:24', 1, '2024-03-05 15:18:45', 5),
(4, 'Dallas, TX', 28, NULL, b'0', '2024-03-03 12:45:24', 1, '2024-03-03 12:45:24', 1),
(5, 'Miami, FL', 38, NULL, b'0', '2024-03-03 12:45:24', 1, '2024-03-03 12:45:24', 1),
(6, 'Seattle, WA', 42, NULL, b'0', '2024-03-03 12:45:24', 1, '2024-03-03 12:45:24', 1),
(7, 'Denver, CO', 32, NULL, b'0', '2024-03-03 12:45:24', 1, '2024-03-03 12:45:24', 1),
(8, 'Atlanta, GA', 29, NULL, b'0', '2024-03-03 12:45:24', 1, '2024-03-03 12:45:24', 1),
(9, 'Phoenix, AZ', 37, NULL, b'0', '2024-03-03 12:45:24', 1, '2024-03-03 12:45:24', 1),
(10, 'Houston, TX', 27, NULL, b'0', '2024-03-03 12:45:24', 1, '2024-03-03 12:45:24', 1),
(11, 'Boston, MA', 38, NULL, b'0', '2024-03-03 12:45:24', 1, '2024-03-03 12:45:24', 1),
(12, 'Detroit, MI', 30, NULL, b'0', '2024-03-03 12:45:24', 1, '2024-03-03 12:45:24', 1),
(13, 'Philadelphia, PA', 35, NULL, b'0', '2024-03-03 12:45:24', 1, '2024-03-03 12:45:24', 1),
(14, 'Washington D.C.', 32, NULL, b'0', '2024-03-03 12:45:24', 1, '2024-03-03 12:45:24', 1),
(15, 'San Francisco, CA', 45, NULL, b'0', '2024-03-03 12:45:24', 1, '2024-03-03 12:45:24', 1),
(16, 'San Diego, CA', 42, NULL, b'0', '2024-03-03 12:45:24', 1, '2024-03-03 12:45:24', 1),
(17, 'Austin, TX', 26, NULL, b'0', '2024-03-03 12:45:24', 1, '2024-03-03 12:45:24', 1),
(18, 'Jacksonville, FL', 34, NULL, b'0', '2024-03-03 12:45:24', 1, '2024-03-03 12:45:24', 1),
(19, 'Columbus, OH', 30, NULL, b'0', '2024-03-03 12:45:24', 1, '2024-03-03 12:45:24', 1),
(20, 'Charlotte, NC', 31, NULL, b'0', '2024-03-03 12:45:24', 1, '2024-03-03 12:45:24', 1),
(21, 'Indianapolis, IN', 29, NULL, b'0', '2024-03-03 12:45:24', 1, '2024-03-03 12:45:24', 1),
(22, 'San Antonio, TX', 27, NULL, b'0', '2024-03-03 12:45:24', 1, '2024-03-03 12:45:24', 1),
(23, 'New York City, NY', 35, NULL, b'0', '2024-03-03 12:55:25', 1, '2024-03-03 12:55:25', 1),
(24, 'Oregon, OR', 23.3, NULL, b'0', '2024-03-05 15:20:03', 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ecatalogue_category`
--

CREATE TABLE `ecatalogue_category` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `remark` varchar(500) DEFAULT NULL,
  `deleted` bit(1) DEFAULT b'0',
  `createdat` datetime DEFAULT NULL,
  `createdby` int(11) DEFAULT NULL,
  `lastmodifiedat` datetime DEFAULT NULL,
  `lastmodifiedby` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ecatalogue_category`
--

INSERT INTO `ecatalogue_category` (`id`, `name`, `remark`, `deleted`, `createdat`, `createdby`, `lastmodifiedat`, `lastmodifiedby`) VALUES
(1, 'Glazed vitrified tiles', NULL, b'0', '2024-03-12 10:22:04', 1, NULL, NULL),
(2, 'Ceramic tiles', NULL, b'0', '2024-03-12 10:22:08', 1, NULL, NULL),
(3, 'Polished vitrified tiles', NULL, b'0', '2024-03-12 10:22:13', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ecatalogue_file`
--

CREATE TABLE `ecatalogue_file` (
  `id` int(11) NOT NULL,
  `catalogueid` int(11) NOT NULL,
  `originalfilename` varchar(300) NOT NULL,
  `ext` varchar(10) NOT NULL,
  `serverfilename` varchar(300) NOT NULL,
  `remark` varchar(500) DEFAULT NULL,
  `deleted` bit(1) DEFAULT b'0',
  `downloaded` int(11) NOT NULL DEFAULT 0,
  `createdat` datetime DEFAULT NULL,
  `createdby` int(11) DEFAULT NULL,
  `lastmodifiedat` datetime DEFAULT NULL,
  `lastmodifiedby` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ecatalogue_file`
--

INSERT INTO `ecatalogue_file` (`id`, `catalogueid`, `originalfilename`, `ext`, `serverfilename`, `remark`, `deleted`, `downloaded`, `createdat`, `createdby`, `lastmodifiedat`, `lastmodifiedby`) VALUES
(1, 1, 'Cool tile catalogue No2.pdf', '.pdf', '65f02d8838cea.pdf', NULL, b'0', 1, '2024-03-12 10:25:12', 1, NULL, NULL),
(2, 2, 'Granalt 800x2400 catalogue (updated).pdf', '.pdf', '65f02d9e79c89.pdf', NULL, b'0', 0, '2024-03-12 10:25:34', 1, NULL, NULL),
(3, 3, 'Sahara double body tiles 600x600 catalogue.pdf', '.pdf', '65f02e0bb5736.pdf', NULL, b'0', 0, '2024-03-12 10:27:23', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `function`
--

CREATE TABLE `function` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `url` varchar(250) NOT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `remark` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `function`
--

INSERT INTO `function` (`id`, `name`, `url`, `description`, `remark`) VALUES
(1, 'Manage Role', '<a href=\"http://localhost:8000/admin/role\" class=\"menu-link\"><div data-i18n=\"Account\">Role</div></a>', 'User can create/update roles', NULL),
(2, 'Manage Employee', '<a href=\"http://localhost:8000/admin/employee\" class=\"menu-link\"><div data-i18n=\"Account\">Employee</div></a>', 'Users can create/update and delete accounts', NULL),
(3, 'Company Infomation', '<a href=\"http://localhost:8000/admin/companyinfo\" class=\"menu-link\"><div data-i18n=\"Account\">Company information</div></a>', 'Allow user to edit company information', NULL),
(4, 'Contact Request', '<a href=\"http://localhost:8000/admin/contactrequest\" class=\"menu-link\"><div data-i18n=\"Account\">Contact Requests</div></a>', 'See all contact request and remark done if staff finish contact customer', NULL),
(5, 'Blog Category', '<a href=\"http://localhost:8000/admin/blogcategory\" class=\"menu-link\"><div data-i18n=\"Account\">Category</div></a>', 'Manage blog category', NULL),
(6, 'Blog Article', '<a href=\"http://localhost:8000/admin/blogarticle\" class=\"menu-link\"><div data-i18n=\"Account\">Article</div></a>', 'Can create/modify blog article', NULL),
(7, 'Manage Delivery Fee', '<a href=\"http://localhost:8000/admin/deliveryfee\" class=\"menu-link\"><div data-i18n=\"Account\">Delivery Fee</div></a>', 'Create, edit, delete delivery fee', NULL),
(8, 'Manage Voucher', '<a href=\"http://localhost:8000/admin/voucherlist\" class=\"menu-link\"><div data-i18n=\"Account\">Voucher</div></a>', 'Create/ Modify/ Delete voucher', NULL),
(9, 'E-Catalogue Category', '<a href=\"http://localhost:8000/admin/ecataloguecategorylist\" class=\"menu-link\"><div data-i18n=\"Account\">Category</div></a>', 'Add/modify/delete e-catalogue category', NULL),
(10, 'E-Catalogue Files', '<a href=\"http://localhost:8000/admin/ecataloguefilelist\" class=\"menu-link\"><div data-i18n=\"Account\">Files</div></a>', 'Add/modify/delete e-catalogue files', NULL),
(11, 'Admin Dashboard', '<a href=\"http://localhost:8000/admin/dashboard\" class=\"menu-link\"><div data-i18n=\"Account\">Dashboard</div></a>', 'View overall system data', NULL),
(12, 'Main Category', '<a href=\"http://localhost:8000/admin/category/categorymain\" class=\"menu-link\"><div data-i18n=\"Account\">Main Category</div></a>', 'Create/revise/delete main category', NULL),
(13, 'Sub Category', '<a href=\"http://localhost:8000/admin/category/categorysub\" class=\"menu-link\"><div data-i18n=\"Account\">Sub Category</div></a>', 'Create/update/delete child categories', NULL),
(14, 'Manage Product', '<a href=\"http://localhost:8000/admin/product/productlist\" class=\"menu-link\"><div data-i18n=\"Account\">Manage Product</div></a>', 'Add/update/delete products', NULL),
(15, 'Orders', '<a href=\"http://localhost:8000/admin/order/orderlist\" class=\"menu-link\"><div data-i18n=\"Account\">Order List</div></a>', 'See customer orders', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `subcategoryid` int(11) NOT NULL,
  `mainimage` varchar(250) DEFAULT NULL,
  `description` text NOT NULL,
  `sellingprice` float UNSIGNED NOT NULL,
  `remark` varchar(500) DEFAULT NULL,
  `origin` varchar(150) NOT NULL,
  `color` varchar(100) DEFAULT NULL,
  `material` varchar(250) DEFAULT NULL,
  `size` varchar(250) DEFAULT NULL,
  `application` varchar(100) DEFAULT NULL,
  `packingdetails` varchar(250) DEFAULT NULL,
  `deleted` bit(1) DEFAULT b'0',
  `createdby` int(30) DEFAULT NULL,
  `createdat` datetime DEFAULT NULL,
  `lastmodifiedby` int(30) DEFAULT NULL,
  `lastmodifiedat` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `subcategoryid`, `mainimage`, `description`, `sellingprice`, `remark`, `origin`, `color`, `material`, `size`, `application`, `packingdetails`, `deleted`, `createdby`, `createdat`, `lastmodifiedby`, `lastmodifiedat`) VALUES
(1, 'American Quartzite', 1, '65effd33297c4.jpg', 'Material	Rectified Porcelain<br />\r\nSizes	4″x12″ | 12″x24″ | 24″x48″ | 2″x2 Mosaic<br />\r\nFinish    Matte<br />\r\nThickness	10 mm<br />\r\nAbrasion Resistance	PEI V<br />\r\nApplication	Floor | Wall<br />\r\nSetting	Residential | Commercial<br />\r\nEdge	Rectified<br />\r\nCountry of Origin	USA<br />\r\nPackaging Details	<br />\r\n4″x 12″ – 36 pc/box | 15.5 sq. ft/box<br />\r\n12″x 24″ – 8 pc/box | 15.5 sq. ft/box<br />\r\n24″x48″- 2 pc/box | 15.5 sq. ft/box<br />\r\n2″x2″ Mosaic 10 pc/ box | 9.7 sq. ft/box<br />\r\n3’x24′ Bullnose 10 pc/ box', 12.78, NULL, 'USA', 'Grey', 'Rectified Porcelain', '4″x 12″', 'Floor | Wall', '8 pc/box | 15.5 sq. ft/box', b'0', 1, '2024-03-12 06:58:59', 1, '2024-03-14 04:51:49'),
(2, 'Absolute', 1, '65effdeb28375.jpg', 'Material	Wall | Floor<br />\r\nSize	        8″x24″ | 3″x18″ Bullnose| 18″x18″<br />\r\nThickness	9 mm<br />\r\nAbrasion Resistance	Wall | Floor<br />\r\nFinish	       Glazed<br />\r\nCountry of Origin	Portugal<br />\r\nEdge	        Round Edge<br />\r\nApplication	Wall | Floor<br />\r\nSetting	       Residential | Commercial<br />\r\nPackaging   Details	8″x24″ – 8 pc/box | 10.33   sq ft/box<br />\r\n                       3″x18″ – 18 pc/box<br />\r\n                      18″x18″ – 8 pc/box | 17.44 sf ft/box', 33.12, NULL, 'Portugal', 'White - Grey', 'Porcelain', '8″x24″', 'Wall | Floor', '8 pc/box | 17.44 sf ft/box', b'0', 1, '2024-03-12 07:02:03', 1, '2024-03-14 04:51:53'),
(3, 'Agatha', 1, '65effecee813b.jpg', 'Material	Porcelain | Glazed Double Fired Ceramic<br />\r\nSize	        10″x22″ Flat | 13″x13″ | 2″x2″ mosaic | 3″x10″ bullnose<br />\r\nFinish	        Matte<br />\r\nCountry of Origin	Portugal<br />\r\nApplication	Wall/Floor<br />\r\nPackaging Details	10″x22″ Flat– 10 pc/box | 14.8 sq ft/box<br />\r\n                                        10″x22″ Ondas– 10 pc/box | 14.8 sq ft/box<br />\r\n                                        13″x13″ – 12 pc/box | 14.35 sq ft/box<br />\r\n                                        2″x2″ Mosaic – 9 pc/box<br />\r\n3″x10″ Bullnose- 12 pc/box', 46, NULL, 'Portugal', 'White-Blue', 'Double Fired Body Ceramic', '10″x22″', 'Wall | Floor', '12 pc/box | 14.35 sq ft/box', b'0', 1, '2024-03-12 07:05:50', 1, '2024-03-14 04:51:51'),
(4, 'Acadian', 4, '65efff5d857a6.jpg', 'Material	Porcelain\r\nSizes	        9″x48″\r\nApplication	Floor | Wall\r\nThickness	9.5mm\r\nVariation	V4\r\nSetting	       Commercial | Residential\r\nCountry of Origin	Spain\r\nFinish	        Matte\r\nPackaging Details	5 pc/box | 14.85 sq. ft/box', 22.88, NULL, 'Spain', NULL, 'Porcelain | Glazed Double Fired Ceramic', '9″x48″', 'Floor | Wall', '5 pc/box | 14.85 sq. ft/box', b'0', 1, '2024-03-12 07:08:13', NULL, NULL),
(5, 'Armani Romano', 4, '65effffb24a28.jpg', 'Material	Porcelain<br />\r\nSize	24″x48″<br />\r\nThickness	10 mm<br />\r\nFinish	<br />\r\nPolished<br />\r\nAbrasion Resistance	  PEI 4<br />\r\nSetting	Residential | Commercial<br />\r\nApplication	Wall | Floor<br />\r\nCountry of Origin	<br />\r\nIndia<br />\r\nPackaging Details	24″x 48″ – 2 pc/box | 15.5 sq ft/box', 12.07, NULL, 'India', 'Grey', 'Porcelain', '24″x48', 'Wall | Floor', '2 pc/box | 15.5 sq ft/box', b'0', 1, '2024-03-12 07:10:51', 1, '2024-03-14 04:52:29'),
(6, 'Artwood', 10, '65f000f004bea.jpg', 'Material: Porcelain<br />\r\nSize: 8″x8″<br />\r\nThickness: 7.5 mm<br />\r\nAbrasion Resistance: PEI IV<br />\r\nCountry of Origin: Spain<br />\r\nFinish: Matte<br />\r\nPackaging Details: 25 pc/box 11.11 sq ft/box', 49.02, NULL, 'Spain', 'Dark-White', 'Porcelain', '8″x8″', 'Decorative', '25 pc/box 11.11 sq ft/box', b'0', 1, '2024-03-12 07:14:55', 1, '2024-03-14 04:52:52'),
(7, 'Beyond', 10, '65f0017ac53c4.jpg', 'Material: 12″x36″ – Rectified Double Fired White Body Ceramic<br />\r\n                  17″x17″ – Rectified Double Fired Polished Porcelain<br />\r\nSize: 12″x36″ | 17″x17″<br />\r\nAbrasion Resistance: PEI IV<br />\r\nCountry of Origin: Spain<br />\r\nPackaging Details: 12″x36″ – 6 pc/ box | 17.19 sq ft/box<br />\r\n                                     17″x17″ – 5 pc/box | 10.72 sq ft/ box<br />\r\n                                      1″x1″ Mosaic – 10 pc/box', 22.67, NULL, 'Spain', 'Marble', 'Rectified Double Fired White Body Ceramic', '12″x36″', 'Floor | Wall', '6 pc/ box | 17.19 sq ft/box', b'0', 1, '2024-03-12 07:17:14', 1, '2024-03-14 04:53:34'),
(8, 'H24', 10, '65f00209d8fe2.jpg', 'Material: Porcelain<br />\r\nSize: 24″x24″<br />\r\nVariation: V1<br />\r\nThickness: 8 mm<br />\r\nAbrasion Resistance: Black – PEI III, Grey – PEI IV, White – PEI V<br />\r\nFinish: Matte<br />\r\nCountry of Origin: Italy<br />\r\nApplication: Wall | Floor<br />\r\nPackaging Details: 4 pc/box 16.25 sq. ft./box', 9.89, NULL, 'Italy', 'Dark Green', 'Porcelain', '24″x24″', 'Floor | Wall', '4 pc/box 16.25 sq. ft./box', b'0', 1, '2024-03-12 07:19:37', 1, '2024-03-14 04:53:39'),
(9, 'Manhattan', 10, '65f002c05e557.jpg', 'Material: Rectified Porcelain<br /><br />\r\nSize: 23.5″x23.5″<br /><br />\r\nAbrasion Resistance: PEI V<br /><br />\r\nFinish: Matte<br /><br />\r\nLook: Wood<br /><br />\r\nCountry of Origin: Spain<br /><br />\r\nSetting: Residential | Commercial<br /><br />\r\nPackaging Details: 3 pc/box | 11.39 sq ft/box', 29.99, NULL, 'Spain', 'Wood', 'Rectified Porcelain', '23.5″x23.5″', 'Floor', '3 pc/box | 11.39 sq ft/box', b'0', 1, '2024-03-12 07:22:40', 1, '2024-03-14 04:54:15'),
(10, 'Legacy', 7, '65f003541d1ed.jpg', 'Material: Porcelain<br /><br />\r\nSize: 12″x24″<br /><br />\r\nThickness: 8 mm<br /><br />\r\nAbrasion Resistance: Black – PEI III, Grey & Taupe – PEI IV, White – PEI V<br /><br />\r\nFinish: Matte<br /><br />\r\nCountry of Origin: Italy<br /><br />\r\nSetting: Residential | Commercial<br /><br />\r\nPackaging Details: 7 pc/box 14.21 sq. ft./box', 19.99, NULL, 'Italy', 'Light Brown', 'Porcelain', '12″x24″', 'Floor | Wall', '7 pc/box 14.21 sq. ft./box', b'0', 1, '2024-03-12 07:25:08', 1, '2024-03-14 04:54:17'),
(11, 'Swimming Sunshine', 14, '65f00437c0836.jpg', 'Material: Glazed Porcelain<br />\r\nSize: 6″x6″<br />\r\nFinish: Glossy<br />\r\nThickness: 8.5 mm<br />\r\nAbrasion: Resistance	PEI II<br />\r\nUse: Swimming Pools | Showers | Backsplash<br />\r\nSetting: Residential | Light Commercial<br />\r\nCountry of Origin: Italy<br />\r\nPackaging Details: 44 pc/box 10.76 sq. ft/box 37 lbs/box', 6.4, NULL, 'Italy', 'Blue', 'Glazed Porcelain', '6″x6″', 'Swimming Pools | Showers | Backsplash', '44 pc/box 10.76 sq. ft/box', b'0', 1, '2024-03-12 07:28:55', 1, '2024-03-14 04:54:37'),
(12, 'Oyama', 2, '65f004ff56475.jpg', 'Material: Super Polished Rectified Porcelain<br />\r\nSizes: 24″x48″<br />\r\nFinish: Super Polished<br />\r\nThickness: 10 mm<br />\r\nAbrasion Resistance: PEI IV<br />\r\nApplication: Floor | Wall<br />\r\nSetting: Residential | Commercial<br />\r\nEdge: Rectified<br />\r\nCountry of Origin: Spain<br />\r\nPackaging Details: 2 pc/box | 15.5 sq. ft/box', 39.99, NULL, 'Spain', 'Marble', 'Super Polished Rectified Porcelain', '24″x48″', 'Floor | Wall', '2 pc/box | 15.5 sq. ft/box', b'0', 1, '2024-03-12 07:32:15', 1, '2024-03-14 04:54:41'),
(13, 'Orion', 8, '65f005a94dbf4.jpg', 'Material: Porcelain\r\nSize: 8.86″x8.86″\r\nFinish: Matte\r\nThickness: 12 mm\r\nAbrasion Resistance: Azul, Granate, Verde – PEI IV, Negro – PEI VI\r\nApplication: Floor | Wall\r\nSetting: Commercial | Residential\r\nCountry of Origin: Spain\r\nPackaging Details: 20 pc/box | 10.87 sq. ft/box', 9.7, NULL, 'Spain', 'Dark-White', 'Porcelain', '8.86″x8.86″', 'Floor | Wall', '20 pc/box | 10.87 sq. ft/box', b'0', 1, '2024-03-12 07:35:05', NULL, NULL),
(15, 'Orinico', 8, '65f0069e141c4.jpg', 'Material: Porcelain<br />\r\nSize: 8″x10″ Hexagon | 3″x18″<br />\r\nThickness: 8 mm<br />\r\nAbrasion: Resistance: PEI IV<br />\r\nFinish: Matte<br />\r\nEdge: Rectified<br />\r\nApplication: Wall | Floor<br />\r\nSetting: Commercial | Residential<br />\r\nCountry of Origin: Spain<br />\r\nPackaging Details: 3″x 18″ – 30 pc/box | 11.41 sq ft/box', 12.2, NULL, 'Spain', 'Grey', 'Porcelain', '8″x10″', 'Wall | Floor', '30 pc/box | 11.41 sq ft/box', b'0', 1, '2024-03-12 07:39:10', 1, '2024-03-14 04:55:07'),
(16, 'Onice Reale', 12, '65f007310e64d.jpg', 'Material: Full-Body Colored Porcelain Stoneware<br />\r\nSizes: 24″x48″<br />\r\nApplication: Floor | Wall<br />\r\nThickness: 10 mm<br />\r\nAbrasion Resistance: Ambra – PEI IV, Oceano, Opale & Smeraldo – PEI III<br />\r\nSetting: Commercial | Residential<br />\r\nFinish: Polished<br />\r\nCountry of Origin: Italy<br />\r\nPackaging: 2 pc/box | 15.5 sq. ft/box', 55.1, NULL, 'Italy', 'Marble', 'Full-Body Colored Porcelain Stoneware', '24″x48″', 'Floor | Wall', '2 pc/box | 15.5 sq. ft/box', b'0', 1, '2024-03-12 07:41:37', 1, '2024-03-14 04:55:11'),
(17, 'Oasis', 13, '65f2617076c0a.jpg', 'Material: Ceramic\r\nSizes: 24×48\r\nApplication: Wall\r\nCountry of Origin: Spain\r\nPackaging Details: 2 pc/box | 16 sq. ft/box | 50 lbs.. per box\r\nFinish: Matte', 43.06, NULL, 'Spain', 'Floral', 'Ceramic', '24\"×48\"', 'Wall', '2 pc/box | 16 sq. ft/box', b'1', 1, '2024-03-14 02:31:12', 1, '2024-03-14 02:37:56'),
(18, 'Oasis', 13, '65f261a5c13c3.jpg', 'Material: Ceramic\r\nSizes: 24×48\r\nApplication: Wall\r\nCountry of Origin: Spain\r\nPackaging Details: 2 pc/box | 16 sq. ft/box | 50 lbs.. per box\r\nFinish: Matte', 43.06, NULL, 'Spain', 'Floral', 'Ceramic', '24\"×48\"', 'Wall', '2 pc/box | 16 sq. ft/box', b'1', 1, '2024-03-14 02:32:05', 1, '2024-03-14 02:37:44'),
(19, 'Oasis', 13, '65f263fb61814.jpg', 'Material: Ceramic<br />\r\nSizes: 24×48<br />\r\nApplication: Wall<br />\r\nCountry of Origin: Spain<br />\r\nPackaging Details: 2 pc/box | 16 sq. ft/box | 50 lbs.. per box<br />\r\nFinish: Matte', 40.05, NULL, 'Spain', 'Floral', 'Ceramic', '24\"×48\"', 'Wall', '2 pc/box | 16 sq. ft/box | 50 lbs.. per box', b'0', 1, '2024-03-14 02:42:03', 1, '2024-03-14 04:55:15'),
(20, 'Inspire', 3, '65f2695a61a89.jpg', 'Material: Porcelain<br /><br />\r\nSize: 8″x10″ <br /><br />\r\nThickness: 10 mm<br /><br />\r\nFinish: Matte<br /><br />\r\nAbrasion Resistance: PEI 4<br /><br />\r\nSetting: Residential | Commercial<br /><br />\r\nApplication: Wall | Floor<br /><br />\r\nLook: Terrazzo<br /><br />\r\nCountry of Origin: Spain<br /><br />\r\nPackaging Details: 8″x 10″ – 25 pc/box | 9.9 sq ft/box', 12.66, NULL, 'Spain', 'Blue', 'Porcelain', '8″x10″', 'Wall | Floor', '25 pc/box | 9.9 sq ft/box', b'0', 1, '2024-03-14 02:45:29', 1, '2024-03-14 04:55:18'),
(21, 'Jarana', 15, '65f26a5ec48bd.jpg', 'Material: Porcelain\r\nSizes: 8.8″x8.8″\r\nApplication: Floor | Wall\r\nSetting: Commercial | Residential\r\nCountry of Origin: Spain\r\nFinish: Matte\r\nPackaging Details: 20 pc/box | 10.76 sq. ft/box | 60 lbs.. per box', 22.1, NULL, 'Spain', 'White-Yellow', 'Porcelain', '8.8″×8.8″', 'Floor | Wall', '20 pc/box | 10.76 sq. ft/box', b'0', 1, '2024-03-14 02:49:13', 1, '2024-03-14 03:09:18'),
(22, 'Nantes', 11, '65f26b55a2bdf.jpg', 'Material: RECTIFIED DESIGN BAMBOO TILE<br />\r\nSizes: 24 X 48<br />\r\nApplication: Wall<br />\r\nCountry of Origin: Spain<br />\r\nPackaging Details: 2 pc/box | 36 BXS/PLT', 12.99, NULL, 'Spain', 'Grey-Dark Yellow', 'Bamboo', '24″×48″', 'Wall', '2 pc/box | 36 BXS/PLT', b'0', 1, '2024-03-14 02:50:11', 1, '2024-03-14 06:11:54'),
(23, 'SPC Leccio', 12, '65f26c27d894e.jpg', 'Material: SPC ECO-FLOORING\r\nSize: 7.2″x48″x5.5\r\nThickness: 12 MIL WEAR LAYER\r\nCountry of Origin: China\r\nApplication: Wall | Floor\r\nPackaging Details: 10 pc/box 23.89 sq. ft./box 64 cs/ plt', 6.7, NULL, 'China', 'Brown', 'SPC ECO-FLOORING', '7.2″x48″', 'Wall | Floor', '10 pc/box 23.89 sq. ft./box', b'0', 1, '2024-03-14 02:56:04', 1, '2024-03-14 03:16:55');

-- --------------------------------------------------------

--
-- Table structure for table `product_image`
--

CREATE TABLE `product_image` (
  `id` int(11) NOT NULL,
  `filename` varchar(250) NOT NULL,
  `productid` int(11) NOT NULL,
  `deleted` bit(1) NOT NULL DEFAULT b'0',
  `createdby` int(11) DEFAULT NULL,
  `createdat` datetime DEFAULT NULL,
  `lastmodifiedby` int(11) DEFAULT NULL,
  `lastmodifiedat` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_image`
--

INSERT INTO `product_image` (`id`, `filename`, `productid`, `deleted`, `createdby`, `createdat`, `lastmodifiedby`, `lastmodifiedat`) VALUES
(1, '65f2695a621c3.jpg', 20, b'0', 1, '2024-03-14 03:04:58', NULL, NULL),
(2, '65f2695a65f25.jpg', 20, b'0', 1, '2024-03-14 03:04:58', NULL, NULL),
(3, '65f2695a66c66.jpg', 20, b'0', 1, '2024-03-14 03:04:58', NULL, NULL),
(4, '65f26a5ec4e87.jpg', 21, b'0', 1, '2024-03-14 03:09:18', NULL, NULL),
(5, '65f26a5ec8c89.jpg', 21, b'0', 1, '2024-03-14 03:09:18', NULL, NULL),
(6, '65f26b55a35a2.jpeg', 22, b'0', 1, '2024-03-14 03:13:25', NULL, NULL),
(7, '65f26b55a4999.jpeg', 22, b'1', 1, '2024-03-14 03:13:25', 1, '2024-03-14 03:39:58'),
(8, '65f26b55a593a.jpeg', 22, b'0', 1, '2024-03-14 03:13:25', NULL, NULL),
(9, '65f26c27d9b25.jpg', 23, b'0', 1, '2024-03-14 03:16:55', NULL, NULL),
(10, '65f26c27ddc27.jpg', 23, b'1', 1, '2024-03-14 03:16:55', 1, '2024-03-14 03:40:46'),
(11, '65f26c27de98d.jpg', 23, b'0', 1, '2024-03-14 03:16:55', NULL, NULL),
(12, '65f26c27e1941.jpg', 23, b'0', 1, '2024-03-14 03:16:55', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_review`
--

CREATE TABLE `product_review` (
  `id` int(11) NOT NULL,
  `commentcontent` varchar(1000) NOT NULL,
  `productid` int(11) NOT NULL,
  `status` bit(1) NOT NULL DEFAULT b'0',
  `deleted` bit(1) NOT NULL DEFAULT b'0',
  `createdby` int(11) DEFAULT NULL,
  `createdat` datetime DEFAULT NULL,
  `lastmodifiedby` int(11) DEFAULT NULL,
  `lastmodifiedat` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_review`
--

INSERT INTO `product_review` (`id`, `commentcontent`, `productid`, `status`, `deleted`, `createdby`, `createdat`, `lastmodifiedby`, `lastmodifiedat`) VALUES
(1, 'This product is very good, reasonable price!', 2, b'1', b'1', 2, '2024-03-14 06:58:47', 1, '2024-03-14 07:13:05'),
(2, 'Just bought it yesterday, price is lower than other palces', 2, b'1', b'0', 2, '2024-03-14 07:34:13', 1, '2024-03-14 07:40:01'),
(3, 'Great!', 2, b'1', b'0', 3, '2024-03-14 07:39:29', 1, '2024-03-14 07:40:05'),
(4, 'test', 23, b'1', b'0', 2, '2024-03-19 11:18:50', 1, '2024-03-19 11:19:09');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `remark` varchar(500) DEFAULT NULL,
  `deleted` bit(1) NOT NULL DEFAULT b'0',
  `createdby` int(11) DEFAULT NULL,
  `createdat` datetime DEFAULT NULL,
  `lastmodifiedby` int(11) DEFAULT NULL,
  `lastmodifiedat` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`, `description`, `remark`, `deleted`, `createdby`, `createdat`, `lastmodifiedby`, `lastmodifiedat`) VALUES
(1, 'Super Admin', 'For business owner', 'Already set when initial project', b'0', NULL, NULL, 5, '2024-03-07 15:23:28'),
(2, 'Moderator', 'Uder Super User', NULL, b'0', NULL, NULL, 5, '2024-03-07 15:39:26'),
(9, 'Test role', 'To delete', NULL, b'0', 2, '2024-03-18 15:22:04', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_function`
--

CREATE TABLE `role_function` (
  `id` int(11) NOT NULL,
  `roleid` int(11) NOT NULL,
  `functionid` int(11) NOT NULL,
  `deleted` bit(1) NOT NULL DEFAULT b'0',
  `createdby` int(11) DEFAULT NULL,
  `createdat` datetime DEFAULT NULL,
  `lastmodifiedby` int(11) DEFAULT NULL,
  `lastmodifiedat` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role_function`
--

INSERT INTO `role_function` (`id`, `roleid`, `functionid`, `deleted`, `createdby`, `createdat`, `lastmodifiedby`, `lastmodifiedat`) VALUES
(1, 1, 1, b'0', NULL, NULL, NULL, NULL),
(2, 1, 2, b'0', 1, '2024-03-12 06:50:31', 1, '2024-03-12 06:50:31'),
(3, 1, 3, b'0', 1, '2024-03-12 06:50:31', 1, '2024-03-12 06:50:31'),
(4, 1, 4, b'0', 1, '2024-03-12 06:50:31', 1, '2024-03-12 06:50:31'),
(5, 1, 5, b'0', 1, '2024-03-12 06:50:31', 1, '2024-03-12 06:50:31'),
(6, 1, 6, b'0', 1, '2024-03-12 06:50:31', 1, '2024-03-12 06:50:31'),
(7, 1, 7, b'0', 1, '2024-03-12 06:50:31', 1, '2024-03-12 06:50:31'),
(8, 1, 8, b'0', 1, '2024-03-12 06:50:31', 1, '2024-03-12 06:50:31'),
(9, 1, 9, b'1', 1, '2024-03-12 06:50:31', 1, '2024-03-12 06:50:31'),
(10, 1, 10, b'1', 1, '2024-03-12 06:50:31', 1, '2024-03-12 06:50:31'),
(11, 1, 11, b'0', 1, '2024-03-12 06:50:31', 1, '2024-03-12 06:50:31'),
(12, 1, 12, b'0', 1, '2024-03-12 06:50:31', 1, '2024-03-12 06:50:31'),
(13, 1, 13, b'0', 1, '2024-03-12 06:50:31', 1, '2024-03-12 06:50:31'),
(14, 1, 14, b'0', 1, '2024-03-12 06:50:31', 1, '2024-03-12 06:50:31'),
(15, 1, 15, b'0', 1, '2024-03-13 15:09:41', 1, '2024-03-13 15:09:41'),
(16, 9, 1, b'0', 2, '2024-03-18 15:22:16', 2, '2024-03-18 15:22:16'),
(17, 9, 2, b'0', 2, '2024-03-18 15:22:16', 2, '2024-03-18 15:22:16'),
(18, 9, 9, b'1', 1, '2024-03-19 10:10:52', 1, '2024-03-19 10:10:52'),
(19, 9, 10, b'1', 1, '2024-03-19 10:10:52', 1, '2024-03-19 10:10:52'),
(20, 9, 8, b'0', 1, '2024-03-19 10:10:59', 1, '2024-03-19 10:10:59'),
(21, 9, 9, b'1', 1, '2024-03-19 10:17:33', 1, '2024-03-19 10:17:33');

-- --------------------------------------------------------

--
-- Stand-in structure for view `salesvolumebycategory`
-- (See below for the actual view)
--
CREATE TABLE `salesvolumebycategory` (
`CategoryName` varchar(150)
,`SubCategoryName` varchar(150)
,`SaleVolume` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Table structure for table `sellingorders`
--

CREATE TABLE `sellingorders` (
  `id` int(11) NOT NULL,
  `buyerid` int(11) DEFAULT NULL,
  `fullname` varchar(250) NOT NULL,
  `address` varchar(1000) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(250) NOT NULL,
  `transactionid` varchar(100) DEFAULT NULL,
  `status` bit(1) DEFAULT NULL,
  `completepaymentat` datetime DEFAULT NULL,
  `subtotalamount` float UNSIGNED NOT NULL,
  `voucheramount` float UNSIGNED NOT NULL,
  `deliverycostamount` float UNSIGNED NOT NULL,
  `grandtotalamount` float UNSIGNED NOT NULL,
  `createdat` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sellingorders`
--

INSERT INTO `sellingorders` (`id`, `buyerid`, `fullname`, `address`, `phone`, `email`, `transactionid`, `status`, `completepaymentat`, `subtotalamount`, `voucheramount`, `deliverycostamount`, `grandtotalamount`, `createdat`) VALUES
(1, NULL, 'James Ann', '84 Sarah Ln, Middletown, NY 10941, United States', '12 12121 212', 'testotheruser@gmail.com', '14L09210NU836253V', b'1', '2024-02-13 11:27:28', 186.48, 18.65, 32, 195.83, '2024-02-13 11:27:28'),
(2, 2, 'James', '84 Sarah Ln, Middletown, NY 10941, United States', '1212121212', 'testotheruser@gmail.com', '9FB58363M72614345', b'1', '2024-03-08 11:28:42', 79.12, 0, 42, 79.12, '2024-03-12 11:28:35'),
(3, 2, 'Nguyen Van A', '84 Sarah Ln, Middletown, NY 10941, United States', '1212121212', 'testotheruser@gmail.com', '4H5474566R723552V', b'1', '2024-03-12 11:38:17', 281.93, 28.19, 42, 253.74, '2024-03-12 11:38:04'),
(4, 3, 'James Wann', '84 Sarah Ln', '12 12121 212', 'testotheruser@gmail.com', '3X262328FW004824V', b'1', '2024-03-14 07:38:09', 33.12, 0, 0, 33.12, '2024-03-14 07:37:57'),
(5, NULL, 'James', '84 Sarah Ln, Middletown, NY 10941, United States', '1212121212', 'testotheruser@gmail.com', '7GH14741GX932460S', b'1', '2024-03-17 05:09:19', 506, 0, 28, 506, '2024-03-17 05:07:16'),
(6, NULL, 'Tester', '84 Sarah Ln, Middletown, NY 10941, United States', '1212121212', 'testotheruser@gmail.com', '58P37636WV374474D', b'1', '2024-03-19 11:13:55', 520.96, 0, 28, 520.96, '2024-03-19 11:13:32'),
(7, 2, 'James', 'asd', '1212121212', 'testotheruser@gmail.com', '12Y700928R252750R', b'1', '2024-03-19 11:18:26', 6.7, 0, 0, 6.7, '2024-03-19 11:18:19');

-- --------------------------------------------------------

--
-- Stand-in structure for view `sellingordersummary`
-- (See below for the actual view)
--
CREATE TABLE `sellingordersummary` (
`sellingyear` int(4)
,`sellingmonth` varchar(32)
,`ordercount` bigint(21)
);

-- --------------------------------------------------------

--
-- Table structure for table `sellingorders_details`
--

CREATE TABLE `sellingorders_details` (
  `id` int(11) NOT NULL,
  `sellingorderid` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `productid` int(11) DEFAULT NULL,
  `deliveryid` int(11) DEFAULT NULL,
  `voucherid` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT 1,
  `amount` float UNSIGNED DEFAULT NULL,
  `addedat` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sellingorders_details`
--

INSERT INTO `sellingorders_details` (`id`, `sellingorderid`, `type`, `productid`, `deliveryid`, `voucherid`, `quantity`, `amount`, `addedat`) VALUES
(1, 1, 'Delivery', NULL, 7, NULL, 1, 32, '2024-03-12 11:27:28'),
(2, 1, 'Voucher', NULL, NULL, 1, 1, 18.65, '2024-03-12 11:27:28'),
(3, 1, 'Product', 1, NULL, NULL, 12, 153.36, '2024-03-12 11:26:11'),
(4, 1, 'Product', 2, NULL, NULL, 1, 33.12, '2024-03-12 11:26:04'),
(5, 2, 'Delivery', NULL, 6, NULL, 1, 42, '2024-03-12 11:28:42'),
(6, 2, 'Product', 2, NULL, NULL, 1, 33.12, '2024-03-12 11:28:16'),
(7, 2, 'Product', 3, NULL, NULL, 1, 46, '2024-03-12 11:28:17'),
(8, 3, 'Delivery', NULL, 6, NULL, 1, 42, '2024-03-12 11:38:17'),
(9, 3, 'Voucher', NULL, NULL, 1, 1, 28.19, '2024-03-12 11:38:17'),
(10, 3, 'Product', 7, NULL, NULL, 12, 272.04, '2024-03-12 11:37:29'),
(11, 3, 'Product', 8, NULL, NULL, 1, 9.89, '2024-03-12 11:37:22'),
(12, 4, 'Product', 2, NULL, NULL, 1, 33.12, '2024-03-14 07:34:51'),
(13, 5, 'Delivery', NULL, 4, NULL, 1, 28, '2024-03-17 05:09:19'),
(14, 5, 'Product', 3, NULL, NULL, 11, 506, '2024-03-17 05:07:00'),
(15, 6, 'Delivery', NULL, 4, NULL, 1, 28, '2024-03-19 11:13:55'),
(16, 6, 'Product', 21, NULL, NULL, 23, 508.3, '2024-03-19 11:12:40'),
(17, 6, 'Product', 20, NULL, NULL, 1, 12.66, '2024-03-19 11:12:32'),
(18, 7, 'Product', 23, NULL, NULL, 1, 6.7, '2024-03-19 11:17:58');

-- --------------------------------------------------------

--
-- Table structure for table `user_buyer`
--

CREATE TABLE `user_buyer` (
  `id` int(30) NOT NULL,
  `accounttype` varchar(50) DEFAULT NULL,
  `socialiteid` varchar(100) DEFAULT NULL,
  `fullname` varchar(150) NOT NULL,
  `avatar` varchar(1000) DEFAULT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(300) NOT NULL,
  `dob` date DEFAULT NULL,
  `emailconfirmed` bit(1) NOT NULL,
  `resetpasswordtoken` varchar(50) DEFAULT NULL,
  `tokenexpiredat` datetime DEFAULT NULL,
  `deleted` bit(1) NOT NULL,
  `createdat` datetime DEFAULT NULL,
  `lastmodifiedat` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_buyer`
--

INSERT INTO `user_buyer` (`id`, `accounttype`, `socialiteid`, `fullname`, `avatar`, `email`, `password`, `dob`, `emailconfirmed`, `resetpasswordtoken`, `tokenexpiredat`, `deleted`, `createdat`, `lastmodifiedat`) VALUES
(1, 'Registed', NULL, 'James Ann', NULL, 'testotheruser@gmail.com', '$2y$10$3PlSgRkkODsOSW2qMQ36FeRev/AMZYk6U1C1fQSvCeM3a.jzUGmy.', '2008-06-12', b'1', NULL, NULL, b'0', '2024-03-12 11:16:02', '2024-03-12 11:16:02'),
(2, 'Google', '109299191916321519259', 'Test Google login', 'https://lh3.googleusercontent.com/a/ACg8ocL1yWNLgNwlZPf-nQGoiF6pHWQabtTomTAdCYKwLJBNAw=s96-c', 'testotheruser@gmail.com', '$2y$10$io9.UDDksahePVENBhKiGORQKcef24727Qo43qZpbx3BYfc4Lvq3K', NULL, b'1', NULL, NULL, b'0', '2024-03-12 11:24:49', '2024-03-12 11:24:49'),
(3, 'Facebook', '122110495604214605', 'Cera TheCompany', 'https://graph.facebook.com/v3.3/122110495604214605/picture?type=normal', 'ceracompany.public@gmail.com', '$2y$10$ZYnBOEpvaeESNXFOQFqEPe8ssl1by5U91iIj8Qm4aWQcnLH7LD3g.', NULL, b'1', NULL, NULL, b'0', '2024-03-14 07:34:32', '2024-03-14 07:34:32');

-- --------------------------------------------------------

--
-- Table structure for table `user_employee`
--

CREATE TABLE `user_employee` (
  `id` int(11) NOT NULL,
  `firstname` varchar(150) NOT NULL,
  `lastname` varchar(150) NOT NULL,
  `address` varchar(500) NOT NULL,
  `phonenumber` varchar(100) NOT NULL,
  `idnumber` varchar(100) NOT NULL,
  `profilepicture` varchar(250) DEFAULT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(300) NOT NULL,
  `dob` date NOT NULL,
  `joindate` date NOT NULL,
  `resetpasswordtoken` varchar(50) DEFAULT NULL,
  `tokenexpiredat` datetime DEFAULT NULL,
  `remember_token` varchar(500) DEFAULT NULL,
  `loginfailcount` int(2) NOT NULL DEFAULT 0,
  `lockendat` datetime DEFAULT NULL,
  `roleid` int(11) NOT NULL,
  `deleted` bit(1) NOT NULL DEFAULT b'0',
  `createdby` int(11) DEFAULT NULL,
  `createdat` datetime DEFAULT NULL,
  `lastmodifiedby` int(11) DEFAULT NULL,
  `lastmodifiedat` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_employee`
--

INSERT INTO `user_employee` (`id`, `firstname`, `lastname`, `address`, `phonenumber`, `idnumber`, `profilepicture`, `email`, `password`, `dob`, `joindate`, `resetpasswordtoken`, `tokenexpiredat`, `remember_token`, `loginfailcount`, `lockendat`, `roleid`, `deleted`, `createdby`, `createdat`, `lastmodifiedby`, `lastmodifiedat`) VALUES
(1, 'Cera', 'Super Admin', 'Initial User', 'Initial User', 'Initial User', '65effc060879c.png', 'ceracompany.public@gmail.com', '$2y$10$p9nxm8Jd1s0suWAa2P9VveIRl7iURIiuJuNgXC9RvNZpah4yguJFG', '1995-01-19', '2024-03-01', NULL, NULL, 'pO7dHWoc4kEE582hU7YYrnvLgKnjtCyBIGXv8UVkRDlDgmvZn9URES6IBZDu', 0, NULL, 1, b'0', NULL, NULL, 1, '2024-03-12 06:53:57'),
(2, 'Nguyen', 'Arthur', '123-Dien Bien Phu-P33', '123456789', 'QW 1212 UDUD 0129', 'noAvatar.jpg', 'testotheruser@gmail.com', '$2y$10$TK03/CAeURkqMB7fF2s.c.teJsjAXUVZN8ZWaXwx/h0LSKem2LFRi', '2024-03-14', '2024-03-06', NULL, NULL, NULL, 0, NULL, 9, b'0', 1, '2024-03-17 04:49:59', 2, '2024-03-18 15:22:36');

-- --------------------------------------------------------

--
-- Table structure for table `voucher`
--

CREATE TABLE `voucher` (
  `id` int(11) NOT NULL,
  `type` varchar(150) NOT NULL,
  `vouchercode` varchar(50) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `value` int(11) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `validfrom` datetime NOT NULL,
  `validto` datetime NOT NULL,
  `deleted` bit(1) NOT NULL DEFAULT b'0',
  `createdat` datetime DEFAULT NULL,
  `createdby` int(11) DEFAULT NULL,
  `lastmodifiedat` datetime DEFAULT NULL,
  `lastmodifiedby` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `voucher`
--

INSERT INTO `voucher` (`id`, `type`, `vouchercode`, `description`, `value`, `quantity`, `validfrom`, `validto`, `deleted`, `createdat`, `createdby`, `lastmodifiedat`, `lastmodifiedby`) VALUES
(1, 'Percentage discount on amount', 'ZXA-SASDVW-ERWER32434', 'Black friday', 10, 12, '2024-03-05 00:00:00', '2024-03-24 00:00:00', b'0', '2024-03-12 11:22:38', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure for view `salesvolumebycategory`
--
DROP TABLE IF EXISTS `salesvolumebycategory`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `salesvolumebycategory`  AS SELECT `c`.`name` AS `CategoryName`, `cs`.`name` AS `SubCategoryName`, sum(`s`.`quantity`) AS `SaleVolume` FROM (((`sellingorders_details` `s` left join `product` `p` on(`s`.`productid` = `p`.`id`)) left join `category_sub` `cs` on(`p`.`subcategoryid` = `cs`.`id`)) left join `category` `c` on(`cs`.`categoryid` = `c`.`id`)) WHERE `s`.`productid` is not null GROUP BY `c`.`name`, `cs`.`name` ;

-- --------------------------------------------------------

--
-- Structure for view `sellingordersummary`
--
DROP TABLE IF EXISTS `sellingordersummary`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `sellingordersummary`  AS SELECT year(`sellingorders`.`createdat`) AS `sellingyear`, date_format(`sellingorders`.`createdat`,'%b') AS `sellingmonth`, count(`sellingorders`.`id`) AS `ordercount` FROM `sellingorders` WHERE `sellingorders`.`status` = 1 GROUP BY year(`sellingorders`.`createdat`), date_format(`sellingorders`.`createdat`,'%b') ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog_article`
--
ALTER TABLE `blog_article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_blogarticle_blogcategory` (`blogcategoryid`),
  ADD KEY `FK_blogarticle_useremployee` (`createdby`);

--
-- Indexes for table `blog_category`
--
ALTER TABLE `blog_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_comment`
--
ALTER TABLE `blog_comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_blogcomment_blogarticle` (`blogarticleid`),
  ADD KEY `FK_blogcomment_userbuyer` (`createdby`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_sub`
--
ALTER TABLE `category_sub`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_subcategory_category` (`categoryid`);

--
-- Indexes for table `companyinfo`
--
ALTER TABLE `companyinfo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contactrequest`
--
ALTER TABLE `contactrequest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deliveryfee`
--
ALTER TABLE `deliveryfee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ecatalogue_category`
--
ALTER TABLE `ecatalogue_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ecatalogue_file`
--
ALTER TABLE `ecatalogue_file`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_ecatloguecategory_ecatologuefile` (`catalogueid`);

--
-- Indexes for table `function`
--
ALTER TABLE `function`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_product_subcategory` (`subcategoryid`);

--
-- Indexes for table `product_image`
--
ALTER TABLE `product_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_productimage_product` (`productid`);

--
-- Indexes for table `product_review`
--
ALTER TABLE `product_review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Productreview_Product` (`productid`),
  ADD KEY `FK_Productreview_User` (`createdby`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_function`
--
ALTER TABLE `role_function`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_rolefunction_role` (`roleid`),
  ADD KEY `FK_rolefunction_function` (`functionid`);

--
-- Indexes for table `sellingorders`
--
ALTER TABLE `sellingorders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_sellingorder_userbuyer` (`buyerid`);

--
-- Indexes for table `sellingorders_details`
--
ALTER TABLE `sellingorders_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_sellingorderdetails_product` (`productid`),
  ADD KEY `FK_sellingorderdetails_delivery` (`deliveryid`),
  ADD KEY `FK_sellingorderdetails_voucher` (`voucherid`),
  ADD KEY `FK_sellingorderdetails_sellingorders` (`sellingorderid`);

--
-- Indexes for table `user_buyer`
--
ALTER TABLE `user_buyer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_employee`
--
ALTER TABLE `user_employee`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_useremployee_role` (`roleid`);

--
-- Indexes for table `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vouchercode` (`vouchercode`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog_article`
--
ALTER TABLE `blog_article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `blog_category`
--
ALTER TABLE `blog_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `blog_comment`
--
ALTER TABLE `blog_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `category_sub`
--
ALTER TABLE `category_sub`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `companyinfo`
--
ALTER TABLE `companyinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contactrequest`
--
ALTER TABLE `contactrequest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `deliveryfee`
--
ALTER TABLE `deliveryfee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `ecatalogue_category`
--
ALTER TABLE `ecatalogue_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ecatalogue_file`
--
ALTER TABLE `ecatalogue_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `function`
--
ALTER TABLE `function`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `product_image`
--
ALTER TABLE `product_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `product_review`
--
ALTER TABLE `product_review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `role_function`
--
ALTER TABLE `role_function`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `sellingorders`
--
ALTER TABLE `sellingorders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sellingorders_details`
--
ALTER TABLE `sellingorders_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user_buyer`
--
ALTER TABLE `user_buyer`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_employee`
--
ALTER TABLE `user_employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `voucher`
--
ALTER TABLE `voucher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blog_article`
--
ALTER TABLE `blog_article`
  ADD CONSTRAINT `FK_blogarticle_blogcategory` FOREIGN KEY (`blogcategoryid`) REFERENCES `blog_category` (`id`) ON DELETE NO ACTION,
  ADD CONSTRAINT `FK_blogarticle_useremployee` FOREIGN KEY (`createdby`) REFERENCES `user_employee` (`id`) ON DELETE NO ACTION;

--
-- Constraints for table `blog_comment`
--
ALTER TABLE `blog_comment`
  ADD CONSTRAINT `FK_blogcomment_blogarticle` FOREIGN KEY (`blogarticleid`) REFERENCES `blog_article` (`id`) ON DELETE NO ACTION,
  ADD CONSTRAINT `FK_blogcomment_userbuyer` FOREIGN KEY (`createdby`) REFERENCES `user_buyer` (`id`) ON DELETE NO ACTION;

--
-- Constraints for table `category_sub`
--
ALTER TABLE `category_sub`
  ADD CONSTRAINT `FK_subcategory_category` FOREIGN KEY (`categoryid`) REFERENCES `category` (`id`) ON DELETE NO ACTION;

--
-- Constraints for table `ecatalogue_file`
--
ALTER TABLE `ecatalogue_file`
  ADD CONSTRAINT `FK_ecatloguecategory_ecatologuefile` FOREIGN KEY (`catalogueid`) REFERENCES `ecatalogue_category` (`id`) ON DELETE NO ACTION;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_product_subcategory` FOREIGN KEY (`subcategoryid`) REFERENCES `category_sub` (`id`) ON DELETE NO ACTION;

--
-- Constraints for table `product_image`
--
ALTER TABLE `product_image`
  ADD CONSTRAINT `FK_productimage_product` FOREIGN KEY (`productid`) REFERENCES `product` (`id`) ON DELETE NO ACTION;

--
-- Constraints for table `product_review`
--
ALTER TABLE `product_review`
  ADD CONSTRAINT `FK_Productreview_Product` FOREIGN KEY (`productid`) REFERENCES `product` (`id`) ON DELETE NO ACTION,
  ADD CONSTRAINT `FK_Productreview_User` FOREIGN KEY (`createdby`) REFERENCES `user_buyer` (`id`) ON DELETE NO ACTION;

--
-- Constraints for table `role_function`
--
ALTER TABLE `role_function`
  ADD CONSTRAINT `FK_rolefunction_function` FOREIGN KEY (`functionid`) REFERENCES `function` (`id`),
  ADD CONSTRAINT `FK_rolefunction_role` FOREIGN KEY (`roleid`) REFERENCES `role` (`id`);

--
-- Constraints for table `sellingorders`
--
ALTER TABLE `sellingorders`
  ADD CONSTRAINT `FK_sellingorder_userbuyer` FOREIGN KEY (`buyerid`) REFERENCES `user_buyer` (`id`) ON DELETE NO ACTION;

--
-- Constraints for table `sellingorders_details`
--
ALTER TABLE `sellingorders_details`
  ADD CONSTRAINT `FK_sellingorderdetails_delivery` FOREIGN KEY (`deliveryid`) REFERENCES `deliveryfee` (`id`) ON DELETE NO ACTION,
  ADD CONSTRAINT `FK_sellingorderdetails_product` FOREIGN KEY (`productid`) REFERENCES `product` (`id`) ON DELETE NO ACTION,
  ADD CONSTRAINT `FK_sellingorderdetails_sellingorders` FOREIGN KEY (`sellingorderid`) REFERENCES `sellingorders` (`id`) ON DELETE NO ACTION,
  ADD CONSTRAINT `FK_sellingorderdetails_voucher` FOREIGN KEY (`voucherid`) REFERENCES `voucher` (`id`) ON DELETE NO ACTION;

--
-- Constraints for table `user_employee`
--
ALTER TABLE `user_employee`
  ADD CONSTRAINT `FK_useremployee_role` FOREIGN KEY (`roleid`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
