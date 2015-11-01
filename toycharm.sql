CREATE TABLE mysql.toys (
  item INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  title VARCHAR(255) NOT NULL,
  shortdesc VARCHAR(255) DEFAULT NULL,
  date DATE DEFAULT NULL,
  price DOUBLE(10, 3) DEFAULT NULL,
  pics VARCHAR(255) DEFAULT NULL,
  featured BOOL DEFAULT NULL,
  longdesc VARCHAR(1000) DEFAULT NULL,
  quantity INT(11) DEFAULT NULL,
  saleprice DOUBLE(10, 3) DEFAULT NULL,
  visible BOOL DEFAULT NULL,
  bestseller BOOL DEFAULT NULL,
  cat_id INT(5) DEFAULT NULL,
  PRIMARY KEY (item)
)
ENGINE = MYISAM
AUTO_INCREMENT = 1
CHARACTER SET latin1
COLLATE latin1_swedish_ci;

CREATE TABLE mysql.users (
  user_id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  email VARCHAR(255) DEFAULT NULL,
  password VARCHAR(255) DEFAULT NULL,
  firstname VARCHAR(255) DEFAULT NULL,
  lastname VARCHAR(255) DEFAULT NULL,
  address VARCHAR(255) DEFAULT NULL,
  city VARCHAR(255) DEFAULT NULL,
  prov VARCHAR(255) DEFAULT NULL,
  postal VARCHAR(255) DEFAULT NULL,
  country VARCHAR(255) DEFAULT NULL,
  datecreated VARCHAR(255) DEFAULT NULL,
  ip VARCHAR(255) DEFAULT NULL,
  other VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (user_id)
)
ENGINE = MYISAM
CHARACTER SET latin1
COLLATE latin1_swedish_ci;

CREATE TABLE mysql.category (
  cat_id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `small image` VARCHAR(255) NOT NULL,
  category VARCHAR(255) NOT NULL,
  colour VARCHAR(6) NOT NULL,
  PRIMARY KEY (cat_id)
)
ENGINE = MYISAM
AUTO_INCREMENT = 1
CHARACTER SET latin1
COLLATE latin1_swedish_ci;



SET NAMES 'utf8';

INSERT INTO mysql.toys(item, title, shortdesc, date, price, pics, featured, longdesc, quantity, saleprice, visible, bestseller, cat_id) VALUES
(1, 'Water Drawing Board Baby Play', 'Water Drawing Toys Mat&1 Magic Pen', '2015-07-14', 4, 'Water Drawing Toys.jpg,Water Drawing Toys2.jpg,Water Drawing Toys3.jpg', 0, '\n<p><strong>Material:</strong>&nbsp;Polyester<br>\n  <strong>Size:</strong>&nbsp;45 x 29cm<br>\n  <strong>Age  Range:</strong>&nbsp;5-7 Years,8-11  Years,12-15 Years<br>\n  <strong>The  perfect art travel toy for Grandmother&rsquo;s house and trips:</strong>&nbsp;just fill the pen with water, and create on the magic mat!<br>\n  Kids are  fascinated as colorful images spring up, then slowly fade away.<br>\n  Encourages  creativity, Builds fine motor coordination, help kids master writing tha  alphabet and numbers.<br>\n  The step by  step Illustrations allows kids to create impressive drawing of birds, houses,  people, and more…</p>', 9, NULL, 1, 0, 3);
INSERT INTO mysql.toys(item, title, shortdesc, date, price, pics, featured, longdesc, quantity, saleprice, visible, bestseller, cat_id) VALUES
(2, 'Upgraded X6 H107C 2.4G 4CH RC Drone Quadcopter', 'Upgraded X6 H107C 2.4G 4CH RC Drone Quadcopter W/3 MP Camera RTF Video Record', '2015-07-14', 9, 'Upgraded X6.jpg,Upgraded X62.jpg,Upgraded X63.jpg,Upgraded X64.jpg', 0, '<p><strong>Motor  (x6):</strong>&nbsp;Coreless Motor<br>\n  <strong>Frequency:</strong>&nbsp;2.4GHz<br>\n  <strong>Battery:</strong>&nbsp;3.7V 350mAh<br>\n  <strong>Flight  Time:</strong>&nbsp;around 7  minutes  <strong>Charging  Time:</strong>&nbsp;40 minutes<br>\n  <strong>Transmitter:</strong>&nbsp;2.4Ghz 4 channels<strong>Camera:</strong>&nbsp;0.3 MP<br>\n  <strong>Video  Recording Module:</strong>&nbsp;included<br>\n  <strong>Memory  Card:</strong>&nbsp;Micro  SDHC(excluded)<br>\n  <strong>Size:</strong>&nbsp;8*8*3.5cm<br>\n  <strong>2  Colors for your choice:</strong>&nbsp;Black + White,  Black + Red, Black + Green<br>\n  It''s Fashion,  Vintage, Creative, is a very useful accessory brighten up your look, also as a  gift.<strong> </strong></p>', 26, NULL, 1, 0, 2);
INSERT INTO mysql.toys(item, title, shortdesc, date, price, pics, featured, longdesc, quantity, saleprice, visible, bestseller, cat_id) VALUES
(3, 'New RC UFO Toys Flashing ', 'New RC UFO Toys Flashing LED Induction Infrared Helicopter Hovering And Floating', '2015-07-14', 1, 'New RC UFO.jpg,New RC UFO2.jpg,New RC UFO3,jpg', 0, '<p>The RC UFO is the king of UFO toys! It&rsquo;s no ordinary flying    saucer toy or flying UFO toy. It&rsquo;s controlled by your hand so it&rsquo;s easy to    use and extremely versatile! Not only this, you can become an    extra-terrestrial master in kick control and headers! Remember though, it&rsquo;s    still a UFO toy and not a football so be gentle! Who knows what life lingers    in outer-space but until next then you can have the RC flying saucer to keep    you amused!<br>\n      Recommended for ages 6 +<br>\n      Some assembly required.<br>\n      Adult supervision recommended<br>\n      Control the flyer toy with the palm of your hand.<br>\n      IR Infrared remote to control the UFO<br>\n      UFO/Saucer:&nbsp;13.5cm Diameter<br>\n      The flying saucer is made of polystyrene</p>', 22, NULL, 1, 0, 1);
INSERT INTO mysql.toys(item, title, shortdesc, date, price, pics, featured, longdesc, quantity, saleprice, visible, bestseller, cat_id) VALUES
(4, '5M 28 LED Snowflake String Fairy Ligh', '5M 28 LED Snowflake String Fairy Light Festival Party Wedding Decoration', '2015-07-14', 19, '5M 28 LED Snowflake.jpg,5M 28 LED Snowflake2.jpg,5M 28 LED Snowflake3.jpg', 0, '<p>Pattern:&nbsp;Snowflake<br>\n  Plug  Type:&nbsp;EU Plug<br>\n  Material:&nbsp;LED, Plastic, Electric Component<br>\n  Light  Source Color:&nbsp;Multi-color<br>\n  Product  Dimension:&nbsp;5 M LED quantity:&nbsp;28 LED<br>\n  Input  Voltage:&nbsp;100-240V<br>\n  Energy  saving, environmental friendly<br>\n  Features  cool bright light which isn''t easy to become hot<br>\n  Perfect  for different occasions such as wedding, hotel, business building, festival  ornament, home decoration, shop window, club, concert, singing hall, fashion  show, dancing hall, and stage and so on<br>\n  It  will create awesome visual effects for any occasion and feast your eyes</p>', 12, NULL, 1, 0, 4);
INSERT INTO mysql.toys(item, title, shortdesc, date, price, pics, featured, longdesc, quantity, saleprice, visible, bestseller, cat_id) VALUES
(5, 'Blue Square Shaped LED Digital Unisex Watch', 'Blue Square Shaped LED Digital Unisex Watch', '2015-07-14', 16, 'Blue Square Shaped LED.jpg,Blue Square Shaped LED2.jpg', 1, '<ul>\n      <li><strong>Specification:</strong></li>\n      <li>Band Material: Silicon Rubber</li>\n      <li>Case Material: Plastic</li>\n      <li>Package Weight: 95 g</li>\n      <li>Package Size: 24 x 5 x 2 cm</li>\n    </ul>\n      <p><strong>Main Feature:</strong></p>\n      <ul>\n        <li>High plastic shell, Stainless steel</li>\n        <li>Integrates multi functions in one watch</li>\n        <li>Luxury mirror dial design</li>\n        <li>You can use it as a small mirror, clear mirror, convenient</li>\n        <li>More saving power, LED display will off when no use</li>\n        <li>LED display the time, date, month</li>\n        <li>12 Hours of time</li>\n        <li>The larger word - for easy reading the digits</li>\n        <li>Solid stainless steel back cover</li>\n        <li>Precise time and keep good time</li>\n        <li>Battery included in the watch</li>\n        <li>Ultra-soft and comfortable safety silicone band</li>\n        <li>Good present for your children and relatives and fri', 22, 15, 1, 0, 1);
INSERT INTO mysql.toys(item, title, shortdesc, date, price, pics, featured, longdesc, quantity, saleprice, visible, bestseller, cat_id) VALUES
(6, 'Super Tomas Series Plastic Transformers', 'Super Tomas Series Plastic Transformers Tomas Toy for Kids', '2015-07-14', 8, 'Super Tomas Series.jpg', 1, '<ul><li>Age:                                            Above 3 years old</li>\n<li>Available    Color:                    Multi – Color</li>\n<li>Product    Weight:                   0.130kg</li>\n<li>Package    Size (L x W    x H):         42 x 29 x 5 cm   </li>\n<li>Package    Contents :              1 X    Transformers Tomas Toy</li></ul>', 2, NULL, 1, 0, 3);
INSERT INTO mysql.toys(item, title, shortdesc, date, price, pics, featured, longdesc, quantity, saleprice, visible, bestseller, cat_id) VALUES
(7, 'Power-driven Octopus Toy', 'Cute and Lovely Power-driven Octopus Toy with Music and Lights Function', '2015-07-14', 2, 'Cute and Lovely.jpg', 1, '<p>Age:            12~15 Years, 9~11 years, 6~9 Years <br>\n      3~5 Years, Adults<br>\n      Material :      Plastic                              <br>\n      Package Weight:     0.582kg                <br>\n      Package Size (L x W x H)     -   20.0 x 20.0 x 21.0 cm<br>\nPackage Contents                     1 x Octopus       </p>', 14, NULL, 1, 0, 3);
INSERT INTO mysql.toys(item, title, shortdesc, date, price, pics, featured, longdesc, quantity, saleprice, visible, bestseller, cat_id) VALUES
(8, 'Mini Plane with Lighting and Music  Features', 'Mini Plane with Lighting and Music  Features', '2015-07-14', 14, 'Mini Plane.jpg,Mini Plane2.jpg', 1, '<p>Age    :                               Above 3    years old<br>\n      Features:                       Battery Powered    Musical Model <br>\n      Available    Color:            Pink<br>\n      Package    Weight:           0.258kg<br>\n      Package    Size  ( L x W x H)  :  17.5 x 8.0 x 15.5 cm</p>', 12, NULL, 1, 0, 3);
INSERT INTO mysql.toys(item, title, shortdesc, date, price, pics, featured, longdesc, quantity, saleprice, visible, bestseller, cat_id) VALUES
(9, 'Digital Magic Cube Math Helper', 'Digital Magic Cube Math Helper Toy for Children ', '2015-07-14', 14, 'Digital Magic Cube.jpg', 1, '<p><strong>Main Features:</strong><br>\n      One math good helper for children<br>\n      Cube not only the development of human capacity and enhance logical thinking    ability , exercise the brain and hand coordination<br>\n      It is good for the childrenâ€˜s intellectual development: cultured hand(    muscle flexibility), eyes(six-sided view), brain (spatial thinking)    coordination and the use of clues to solve problems</p>\n      <p>Description<br>\n        Product    Weight                           50kg<br>\n        Package    Weight                           0.11kg<br>\n        Product    Size (LxWxH)                  5.5 x 5.5    x7.1cm <br>\n        Package    Size (LxWxH)                13 x 15    x10cm<br>\n        Package    Contents                      2 x Magic    Cubes</p>', 30, NULL, 1, 0, 5);
INSERT INTO mysql.toys(item, title, shortdesc, date, price, pics, featured, longdesc, quantity, saleprice, visible, bestseller, cat_id) VALUES
(10, '6 Educational Solar Kits with Different Designs', '6 Educational Solar Kits with Different Designs', '2015-07-14', 13, '6 Educational Solar Kits.jpg', 1, '<p><strong>Main Feature:</strong></p>\n          <ul type="disc">\n            <li>Material:Plastic</li>\n            <li>DIY innovation         kind of solar toys</li>\n            <li>Environmental&nbsp;toy</li>\n            <li>Develop the         child''s practice ability</li>\n            <li>Can be assembled         into different shapes the solar puzzle game</li>\n            <li>Children use the         44 snap together parts(no tools required) to build six different working         models,including an airboat,windmill,wheeller,robot,and two different         planes</li>\n            <li>Can improve         children''s intelligence, and enhance intellectual development</li>\n            <li>Funny and educational,it         is the best choice to improve intelligence</li>\n            <li>Make children         learn of solar energy while they create a toy that is both fun to play         with and requires no batteries</li>\n            <li>Enhance&nbsp;the children&nbsp;of&nbsp;energy saving&', 9, NULL, 1, 0, 5);
INSERT INTO mysql.toys(item, title, shortdesc, date, price, pics, featured, longdesc, quantity, saleprice, visible, bestseller, cat_id) VALUES
(11, 'Remote Control Classic Car Toy', 'Remote Control Classic Car Toy', '2015-07-14', 3, 'Remote Control Classic.jpg', 1, '<p><strong>Main    Features:</strong><br>\n      Super high    speed 1:52 RC classic old racing car<br>\n      100% brand new with retail package<br>\n      Racing Series with a turbo switch to run faster&nbsp;<br>\n      Ready to run and no assembly needed&nbsp;<br>\n      Two headlights will turn on automatically when running forward&nbsp;<br>\n      Two taillights will turn on automatically when running backward&nbsp;<br>\n      Can run on the carpet&nbsp;<br>\n      High speed wiht shakeproof function&nbsp;<br>\n      A charging cable is hidden in the transmitter as seen in picture<br>\n      Just race it, and enjoy your great racing fun!</p>', 10, NULL, 1, 0, 2);
INSERT INTO mysql.toys(item, title, shortdesc, date, price, pics, featured, longdesc, quantity, saleprice, visible, bestseller, cat_id) VALUES
(12, 'Super High Speed RC Car with Flashing Light', 'Super High Speed RC Car with Flashing Light', '2015-07-14', 7, 'Super High Speed.jpg,Super High Speed2.jpg', 1, '<p><strong>Main Features:</strong></p>\n      <ul type="disc">\n        <li>Remote control         mini high-speed R/C car</li>\n        <li>Six position         control</li>\n        <li>5 speed         transmision, auto shift</li>\n        <li>Special         protection, roll freely when turning, precise landing</li>\n        <li>Go forward,         speed up forward reverse, turn left, turn right and with flashing         light&nbsp;</li>\n        <li>It can rolling-over         and keep going when it turned over for it with ring</li>\n        <li>You can make         some simple platforms for the car jumping to make it play amusing</li>\n        <li>By developing         intelligence, and inspiring potential</li>\n        <li>To make children         grow up with happiness</li>\n        <li>Recommended for         ages&nbsp;3 and older</li>\n        <li><strong>Specifications:</strong></li>\n        <li>Remote control powered by&nbsp;6 x AA batteries (not         include)</li>\n        <li>Car ba', 9, NULL, 1, 0, 2);
INSERT INTO mysql.toys(item, title, shortdesc, date, price, pics, featured, longdesc, quantity, saleprice, visible, bestseller, cat_id) VALUES
(13, 'Remote Control Helicopter', 'Remote Control Helicopter Toy (Green) with  Built-in Gyroscope', '2015-07-14', 4, 'Remote Control Helicopter.jpg,Remote Control Helicopter2,jpg', 1, '<p><strong>Main Features:</strong><br>\n      Support 2.0 channel infrared control helicopter<br>\n      Function: Up, down, forward, turn left, turn right, 360 degree rotation and    with light<br>\n      All-metal stent, precision control<br>\n      Intelligent, smooth vacant proterties<br>\n      Infrared Control<br>\n      Made by good quality alloy, safe enough for your children to play with&nbsp;<br>\n      No assemble needed, move your fingers and control the helicopter<br>\n      Durable and good for price<br>\n      <strong>Specification:</strong></p>\n      <table border="1" cellspacing="0" cellpadding="0" width="100%">\n        <tr>\n          <td><br>\n            General </td>\n          <td><ul>\n            <li>Feature: Remote Control</li>\n            <li>Functions: 360 degrees      accurate orientation, Turn left/right, Up/down</li>\n            <li>Built-in Gyro: Yes</li>\n            <li>Night Flight: Yes</li>\n            <li>Age: Above 14 years old </li>\n          </ul></td>\n        ', 30, NULL, 1, 1, 2);
INSERT INTO mysql.toys(item, title, shortdesc, date, price, pics, featured, longdesc, quantity, saleprice, visible, bestseller, cat_id) VALUES
(14, 'Magic Intellect Ball Marble Puzzle Game', 'Magic Intellect Ball Marble Puzzle Game', '2015-07-14', 5, 'Magic Intellect Ball.jpg,Magic Intellect Ball2.jpg', 1, '<p><strong>Description:</strong></p>\n      <ul type="disc">\n        <li>The         environmentally friendly magical intellect ball is a big challenge to         intelligence and balancing ability. And the magical intellect ball         improves the &quot;sensation-motion&quot; intelligence of the player: by         controlling moving route of the little ball, the player can improve his         coordination between eyes and hands and also his concentration ability.         Also the magical intellect ball can promote player''s cerebral cortex         development through visual and mind activities. Besides, the kids         intellect ball helps to promote development of both left and right         cerebral hemispheres of the player&nbsp;<br>\n          <br>\n          <strong>Main Feature:</strong></li>\n        <li>The player shall         first learn to observe, try to find out the correct advancing route.         Observation and discovery are two key points for winning the game</li>\n     ', 13, 3.5, 1, 0, 4);
INSERT INTO mysql.toys(item, title, shortdesc, date, price, pics, featured, longdesc, quantity, saleprice, visible, bestseller, cat_id) VALUES
(15, 'Dave Shaped Case Wrist Watch', 'Despicable Me Minion Dave Shaped Case Wrist Watch', '2015-07-14', 7, 'Despicable Me Minion.jpg,Despicable Me Minion2.jpg,Despicable Me Minion3.jpg', 1, '<p><strong>Main Features:</strong><br>\n  No buckle needed, but firmly fit on your wrist<br>\n  Gently pat it in extend status, the strap will roll up<br>\n  Simply adjust to fit with different sizes&nbsp;<br>\n  Easily to put on and take off&nbsp;<br>\n  Silicone wrapped band provide comfortable feeling<br>\n  The watch can take out from the rubber shell<br>\n  Battery loaded<br>\n  Water resistant (not for diving/swimming)<br>\n  It''s worth to buy for cheap and having a good quality<br>\n  <strong>description</strong><br>\n  Watches Categories                     Children Watch<br>\n  Movement Type:                     Quartz Watch<br>\n  Shape of the dial                      Circular<br>\n  Display type                             Pointer<br>\n  The bottom of the table        Ordinary<br>\n  Case material                        Rubber<br>\n  Watch-head                          ordinary<br>\n  Band material                      Rubber<br>\n  Waterproof                          Life waterproof<br>\n  Th', 16, NULL, 1, 0, 5);

SET NAMES 'utf8';

INSERT INTO mysql.category(cat_id, `small image`, category, colour) VALUES
(1, 'girl.png', 'Girl', 'cd2057');
INSERT INTO mysql.category(cat_id, `small image`, category, colour) VALUES
(2, 'boy.png', 'Boy', '3cbb82');
INSERT INTO mysql.category(cat_id, `small image`, category, colour) VALUES
(3, 'toddler.png', 'Toddler', 'fcbf2e');
INSERT INTO mysql.category(cat_id, `small image`, category, colour) VALUES
(4, 'adults.png', 'Gifts For Adults', '833b78');
INSERT INTO mysql.category(cat_id, `small image`, category, colour) VALUES
(5, 'more.png', 'More', '24cbcd');

