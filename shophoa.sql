-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2022 at 11:23 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shophoa`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `type`) VALUES
(3, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `oplace` text CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `mobile` varchar(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `dstatus` varchar(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL DEFAULT 'no',
  `odate` date NOT NULL,
  `ddate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `uid`, `pid`, `quantity`, `oplace`, `mobile`, `dstatus`, `odate`, `ddate`) VALUES
(1, 9, 56, 6, 'Manikganj Sadar', '01677531881', 'Đã xác nhận', '2017-04-07', '2021-09-28'),
(2, 12, 58, 23, 'Nikunja 2, Khilkhet, Dhaka', '01677531881', 'Đã giao', '2017-04-07', '2021-10-23'),
(4, 10, 74, 9, 'South Seota, Manikganj Sadar', '01677531881', 'Đã giao', '2017-04-07', '2021-09-28'),
(9, 11, 66, 1, 'Nikunja 2, Khilkhet, Dhaka', '01677531881', 'Hủy', '2017-04-08', '2021-10-05'),
(10, 11, 71, 3, 'Nikunja 2, Khilkhet, Dhaka', '01677531881', 'Đang giao', '2017-04-08', '2021-10-12'),
(13, 9, 67, 2, 'Nikunja 2, Khilkhet, Dhaka', '01677531881', 'Hủy', '2017-04-08', '2021-10-19'),
(14, 10, 65, 1, 'Nikunja 2, Khilkhet, Dhaka', '01677531881', 'Đang giao', '2017-04-08', '2021-10-16'),
(15, 11, 59, 43, 'Nikunja 2, Khilkhet, Dhaka', '01677531881', 'Đang giao', '2017-04-08', '2021-10-07'),
(35, 9, 56, 5, 'Dhaka, Bangladesh', '01578399283', 'Chờ xác nhận', '2021-10-07', '2021-10-14'),
(36, 9, 73, 2, 'Dhaka, Bangladesh', '01578399283', 'Chờ xác nhận', '2021-10-07', '2021-10-14'),
(40, 9, 74, 1, 'Dhaka, Bangladesh', '01578399283', 'Chờ xác nhận', '2021-10-07', '2021-10-14'),
(44, 14, 74, 7, 'dia chi 12321', '21321', 'Chờ xác nhận', '2021-10-08', '2021-10-16'),
(45, 14, 73, 11, '1231', '21321', 'Hủy', '2021-10-08', '2021-10-15'),
(46, 14, 74, 24, 'diachi112', '1231231', 'Hủy', '2021-10-08', '2021-10-15'),
(47, 13, 73, 5, 'dia chi ao', '01231231242', 'Hủy', '2021-10-08', '2021-10-17'),
(48, 13, 74, 24, 'ádada', '123123', 'Hủy', '2021-10-08', '2021-10-15'),
(49, 13, 74, 24, 'ádada', '123123', 'Chờ xác nhận', '2021-10-08', '2021-10-15'),
(50, 13, 74, 24, 'ádada', '123123', 'Chờ xác nhận', '2021-10-08', '2021-10-15'),
(51, 13, 73, 7, 'ádada', '123123', 'Chờ xác nhận', '2021-10-14', '2021-10-21'),
(52, 13, 74, 24, 'ádada', '123123', 'Chờ xác nhận', '2021-10-14', '2021-10-21'),
(53, 13, 73, 11, 'ádada', '123123', 'Chờ xác nhận', '2021-10-14', '2021-10-21'),
(54, 15, 67, 15, 'dfsfs', '124214214', 'Hủy', '2021-10-16', '2021-10-08'),
(55, 15, 75, 54, '125215125', '124214214', 'Hủy', '2021-10-16', '2021-10-23');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `pName` varchar(100) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `price` int(11) NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `available` int(11) NOT NULL,
  `category` varchar(100) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `picture` text CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `pName`, `price`, `description`, `available`, `category`, `picture`) VALUES
(56, 'Hoa Cẩm tú cầu', 12000, 'Hoa cẩm tú cầu là loại hoa thuộc họ Tú Cầu ( Hydrangeaceae) có tên khoa học là Hydrangea. Có nguồn gốc từ các nước Đông Nam Á, và ngày nay được ưa chuộng trên toàn thế giới. Hoa cẩm tú cầu là loại hoa mọc theo bụi, thân gỗ mềm, sống lâu năm. Hoa cẩm tú cầu thường mọc theo đóa có hình cầu, với những bông hoa nhỏ như cánh bướm, và thường có màu trắng, xanh lam hoặc hồng.', 12, '0', 'cam-tu-cau.jpg'),
(57, 'Hoa Anh đào', 15000, 'Hoa anh đào có tên tiếng anh là Cherry Blossom, tên khoa học là  Prunus cerasoides D.Don, thuộc họ Hoa hồng (Rosacea), là loài hoa có nguồn gốc từ Nhật Bản. Hoa anh đào là loài hoa đẹp, có màu trắng, hồng phấn hoặc đỏ, cuống hoa mềm mại, và có từ 3 – 6 bông. Và đây là loài hoa mang nhiều ý nghĩa biểu tượng sâu sắc: đó là sự tươi mới, niềm vui và hạnh phúc vào mỗi dịp xuân về; đó là mang vẻ đẹp kiêu sa mỏng manh của người phụ nữ hay chính là sức sống mãnh liệt, tin tưởng cho sự sống. ', 58, '0', 'hoa-anh-dao.jpg'),
(58, 'Hoa Baby', 12000, 'Hoa baby (hoa chấm bi) là loại hoa thuộc họ Cẩm chướng, có tên khoa học là Gypsophila, là loại cây thân mềm, mọc thành bụi. Hoa thường mọc tại đầu mỗi cành, mọc thành chùm.', 15, '0', 'hoa-baby.jpg'),
(59, 'Hoa bỉ ngạn', 15000, 'Hoa bỉ ngạn có tên tiếng anh là Lycoris radiata, thuộc họ hoa loa kèn, là loài hoa gắn liền với các truyền thuyết của phương Đông nói chung và văn hóa Trung Quốc nói riêng. Hoa bỉ ngạn là loại thực vật thân thảo cao từ 40 – 100cm, hoa thường mọc trên đỉnh với các đài hoa có từ 5 – 7 nụ hoa nở tỏa ra xung quanh, cành hoa dài vươn thẳng lên trời. Bỉ ngạn thường có 3 màu chính là vàng, đỏ và trắng, tuy nhiên bỉ ngạn đỏ (Mạn Châu Sau) vẫn được biết đến nhiều nhất, với biểu tượng cho những đau thương trong tình yêu.', 46, '0', 'hoa-bi-ngan.jpg'),
(60, 'Hoa Cẩm chướng', 20000, 'Hoa cẩm chướng (hương thạch trúc, hạ lan thạch trúc) có tên khoa học là Dianthus caryophyllus, thuộc họ Cẩm chướng. Là loài hoa đẹp có nguồn gốc từ khu vực Địa Trung Hải. Cẩm chướng là giống cây thân thảo, lá kép, mép lá trơn, hoa cẩm chướng có hai dạng là hoa đơn và hoa kép. Hoa cẩm chướng đơn thường mọc từng bông một ở đầu cành, hoa kép thì mọc thành chùm từ 2 – 5 bông. Và hoa có mùi thơm ngọt ngào, không nồng. Vì thế, hoa cẩm chướng được rất nhiều người yêu thích.', 16, '0', 'hoa-cam-chuong.jpg'),
(61, 'Hoa Cúc', 15000, 'Hoa cúc có tên khoa học là Asteraceae, có nguồn gốc từ nhiều nơi trên thế giới. Hoa cúc thường mọc thành cụm gồm nhiều hoa nhỏ, cánh hoa xếp chồng lên nhau và bao lấy nhụy hoa. Hoa cúc có nhiều loại khác nhau: hoa cúc trắng, cúc họa mi,…', 54, '0', 'hoa-cuc.jpg'),
(62, 'Hoa Dâm bụt', 15000, 'Hoa dâm bụt (Hibiscus Rosa-sinesis) là loại hoa có nguồn gốc từ Trung Quốc và được xem là quốc hoa của Malaysia. Đây là loại cây thân gỗ, có chiều cao từ 4 – 5m, phân nhành, lá mọc đơn, có hình bầu dục và bìa lá có răng cưa. Hoa dâm bụt thường mọc ở nách lá, có từ 5 – 7 cánh, kích thước từ 5 – 10cm.', 16, '0', 'hoa-dam-but.jpg'),
(63, 'Hoa Đồng tiền', 58000, 'Hoa đồng tiền (cúc đồng tiền) có tên khoa học là Gerbera Jamesonii, nguồn gốc đầu tiên tại Nam Phi, Châu Á. Đây là loại hoa thân thảo, cao từ 20 – 55cm, cuống dài, hoa thường mọc trên ngọn, cánh xếp chồng lên nhau, cánh hoa mỏng.', 85, '0', 'hoa-dong-tien.jpg'),
(64, 'Hoa hồng', 42000, 'Là loại hoa có nguồn gốc từ các vùng Trung Á, Bắc Mỹ và châu Âu, hoa hồng được xem là hiện thân của cái đẹp, của sự hoàn mỹ và một tình yêu chân thành. Và hiện nay, hoa hồng có khoảng hơn 100 loài khác nhau: hoa hồng đỏ, hoa hồng cổ sapa, hoa hồng trứng, hoa hồng nhung,… và mỗi loại đều mang một nét đẹp riêng.', 50, '0', 'hoa-hong.jpg'),
(65, 'Hoa huệ', 25000, 'Hoa huệ là loài hoa đẹp gắn liền với mỗi con người Việt Nam vào mỗi dịp lễ, Tết. Hoa huệ là loài hoa nở vào ban đêm, có hương thơm nồng dàn đặc trưng. Hoa huệ có tên khoa học là Polianthes tuberosa, thuộc họ Agavaceae, là loài cây thân thảo, sống lâu năm. Hoa có kích thước nhỏ, cánh hoa có hình thìa, boa hoa hình phễu, có màu trắng.', 25, '0', 'hoa-hue.jpg'),
(66, 'Hoa lan hồ điệp', 24000, 'Là loại hoa có nguồn gốc  từ các nước Đông Nam Á hay trên dãy núi Himalaya, thuộc chi dòng chi hoàng thảo, có tên khoa học là Dendrobium anosmum. Hoa lan hồ điệp là dòng hoa đẹp, thường sống ở nơi có độ cao từ 200 – 400cm, sinh trưởng chậm, cành hoa thường mọc từ nách lá hoặc phần rìa, cành hoa nhỏ và mỗi cây chỉ có từ 1 – 2 cành hoa. Hoa có cánh to, rộng, xếp chồng lên nhau và  thường nở vào ban đêm.', 24, '0', 'hoa-lan-ho-diep-1.jpg'),
(67, 'Hoa lay ơn', 26000, 'Hoa lay ơn (Gladiolus) có nguồn gốc từ châu Phi, là loài hoa lưỡng tính, mọc thành chuỗi dọc. Hoa có hình phễu, mỗi cành hoa có từ 5 – 7 bông với các cánh mỏng xếp chồng lên nhau. Lay ơn là hình ảnh hoa đẹp mang ý nghĩa biểu tượng cho một tình yêu thầm kín mà sâu sắc và thể hiện sự say mê, nhiệt huyết trong cuộc sống.', 24, '0', 'hoa-lay-on.jpg'),
(68, 'Hoa linh lan', 84000, 'Hoa linh lan có tên khoa học là Convallaria majalis, là loài hoa duy nhất thuộc chi Convallaria và họ Ruscaceae, là loại cây thân thảo có nguồn gốc từ các khu vực ôn đới tại châu Á và Bắc Mỹ. Hoa linh lan thường mọc trên đỉnh ngọn, có màu trắng, hình chuông và đường kính từ 5 – 10mm, chỉ nở vào mùa xuân. Với vẻ đẹp thuần khiết, giản dị nên loài hoa này tượng trưng cho sự hạnh phúc và những may mắn trong cuộc sống. Vì thế được xem là một trong những loài hoa đẹp nhất thế giới.', 14, '0', 'hoa-linh-lan.jpg'),
(69, 'Hoa ly', 24000, 'Hoa ly hay còn được biết đến là hoa bách hợp, là một trong những loài hoa đẹp ở Việt Nam, được ưa chuộng vào những dịp lễ, Tết. Hoa ly là loại cây hoa cảnh thân vảy, lá mọc rải rác theo vòm rộng, hoa thường mọc đơn lẻ. Hoa thường có 6 cánh, 6 nhị và hương thơm đặc trưng.', 54, '0', 'hoa-ly.jpg'),
(70, 'Hoa mai', 6500, 'Hoa mai (Ochna integerrima),  thuộc họ Mai (Ochnaceae) là loại hoa đẹp được ưa chuộng vào mỗi dịp Tết Nguyên Đán Việt Nam, phân bố chủ yếu ở các khu vực tỉnh Quảng Nam, đồng bằng sông Cửu Long. Mai thuộc loại cây đa niên, thân gỗ, lá mọc xen kẻ so le nhau, hoa mọc từ các nách lá và tạo thành từng chùm. Hoa mai có nhiều loại: hoa mai vàng, hoa mai đỏ, mai tứ quý, bạch mai.', 10, '0', 'hoa-mai.jpg'),
(71, 'Hoa mẫu đơn', 34000, 'Được xem là “quốc sắc thiên vương” của Trung Quốc, với vẻ đẹp thanh cao, sang trọng, hoa mẫu đơn là loài hoa đẹp nhất được nhiều người yêu thích. Hoa mẫu đơn có tên khoa học là Paeoniaceae, có nguồn gốc từ châu Âu và Tây Bắc Mỹ. Hoa mẫu đơn thường có nhiều màu khác nhau: trắng, đỏ, tím,… có đường kính từ 20 – 30cm. Hoa mẫu đơn có nhiều cánh, từng cánh hoa nhỏ ôm trọn lấy nhụy hoa màu vàng, tạo nên nét đẹp tinh tế và sang trong. Không chỉ đẹp mà hoa mẫu đơn còn được yêu thích bởi hương thơm nồng nàn đặc trưng.', 65, '0', 'hoa-mau-don.jpg'),
(72, 'Hoa mười giờ', 18000, 'Hoa mười giờ hay hoa tí ngọ là loại hoa có nguồn gốc từ Nam Mỹ, thường mọc nhiều tại các đồng cỏ ở làng quê Việt Nam. Hoa mười giờ có tên khoa học là  Portulaca grandiflora, thuộc họ rau sam. Tên gọi của hoa xuất phát từ đặc điểm nở hoa vào lúc 8 – 10 giờ sáng của hoa này. Hoa mười giờ thường mọc ở đầu ngọn và nách lá, cách hoa xếp chồng lên nhau, hoa thường có nhiều màu như hồng, vàng, trắng, đỏ.', 34, '0', 'hoa-muoi-gio.jpg'),
(73, 'Hoa nhài', 40000, 'Hoa nhài có tên khoa học là Asminum sambac, có nguồn gốc từ Ấn Độ, Đông Nam Á. Hoa nhài là loại cât mọc thành bụi, cao từ 50 – 150cm, hoa có màu trắng, cánh hoa xếp trồng lên nhau, hoa thường mọc thành chùm từ 3 – 10 bông. Hoa nhài ra hoa quanh năm nhưng rộ nhất vào mùa hè.', 11, '0', 'hoa-nhai.jpg'),
(74, 'Hoa sen', 54000, 'Hình ảnh hoa sen đẹp có lẽ đã đi vào tiềm thức của mỗi người con Việt Nam từ đời thực đến tranh vẽ. Hoa sen (Nelumbo nucifera) thuộc họ Sen (Nelumbonaceae), là loại thực vật thủy sinh, thân rễ nhiều nhánh, lá sen mọc trên cuống dài vươn lên trên mặt nước. Hoa sen mọc trên cuống lá dài, với cánh hoa đan xen xếp chồng lên nhau, nhụy hoa và lá noãn ở trong. Hoa sen thường nở vào mùa hè, có mùi thanh và dễ chịu.', 24, '0', 'hoa-sen.jpg'),
(75, 'Hoa thiên điều', 35000, '1213', 54, 'Hoa cưới', 'hoa-thien-dieu.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstName` varchar(25) NOT NULL,
  `lastName` varchar(25) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `address` varchar(120) NOT NULL,
  `password` varchar(100) NOT NULL,
  `confirmCode` varchar(10) NOT NULL,
  `activation` varchar(10) NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstName`, `lastName`, `email`, `mobile`, `address`, `password`, `confirmCode`, `activation`) VALUES
(9, 'Borsha', 'Tanjina', 'Tanjina@gmail.com', '01578399283', 'Dhaka, Bangladesh', 'aa030295ae26e8acbd3d1c9415a60f12', '217576', 'yes'),
(10, 'Trisha', 'Rehman', 'trisha@gmail.com', '01923457834', 'Mirpur 2, Dhaka', '5af7a513a7c48f6cc97253254b29509b', '0', 'yes'),
(11, 'Akhi', 'Alam', 'akhi@gmail.com', '01678293748', 'Saver, Dhaka', 'ca52febd8be7c4480ae90cdae8438a03', '0', 'yes'),
(12, 'Dau', 'Duc', 'dauduc@gmail.com', '2124124214', 'asdasda', '202cb962ac59075b964b07152d234b70', '917971', 'no'),
(13, 'Dau', 'Duc', 'test@gmail.com', '123123', 'ádada', 'c73060bc4732b32d7fee4e2c21da72e0', '479132', 'no'),
(14, 'Sadasd', 'ádsad', 'test2@gmail.com', '21321', '1231', 'c73060bc4732b32d7fee4e2c21da72e0', '129217', 'no'),
(15, 'Sadasd', 'Hung', 'test123@gmail.com', '124214214', '125215125', '202cb962ac59075b964b07152d234b70', '101039', 'no');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pid` (`pid`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
