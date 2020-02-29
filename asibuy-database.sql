-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql202.epizy.com
-- Generation Time: פברואר 20, 2020 בזמן 07:51 AM
-- גרסת שרת: 5.6.45-86.1
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `asibuy`
--

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_number` int(9) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- הוצאת מידע עבור טבלה `customers`
--

INSERT INTO `customers` (`id`, `first_name`, `last_name`, `id_number`, `email`, `phone`, `created_at`, `updated_at`) VALUES
(7, 'asi', 'kapner', 837267388, 'asikap@hvr.co.il', '0432885732', '2019-12-22 08:36:07', '2019-12-22 08:42:32'),
(6, 'moshe', 'ufnik', 635728298, 'ufnik@walla.com', '0528789465', '2019-12-22 08:32:31', '2019-12-22 08:32:31'),
(8, 'babea', 'yfjksjkn', 508093333, 'asisssssy@gmail.com', '0548839984', '2019-12-22 08:44:06', '2019-12-23 06:26:34'),
(9, 'moshe', 'alon', 545898669, 'milivanili@gmail.com', '0545898669', '2019-12-30 09:03:57', '2019-12-30 09:03:57'),
(10, 'dudu', 'cohen', 836472891, 'duduc@walla.com', '0525678455', '2020-01-05 13:33:13', '2020-01-05 13:33:13'),
(11, 'yaakov', 'bardugo', 302678745, 'yaakov@gmail.com', '0528765766', '2020-01-21 07:27:21', '2020-01-21 07:27:21'),
(12, 'itzik', 'cohen', 365698677, 'itzikcohen@gmail.com', '0549768215', '2020-01-21 07:28:05', '2020-01-21 07:28:05'),
(13, 'yelena', 'levich', 837716220, 'ylevich@gmail.com', '0558376499', '2020-01-21 07:28:42', '2020-01-21 07:28:42'),
(14, 'dor', 'nehamia', 388746228, 'dorn@gmail.com', '0523398494', '2020-01-21 07:29:21', '2020-01-21 07:29:21'),
(15, 'miri', 'lohasa', 377658229, 'mirilohasa@gmail.com', '0547336225', '2020-01-21 07:30:03', '2020-01-21 07:30:03'),
(16, 'zeev', 'haim', 587322980, 'zeevik@gmail.com', '0522746789', '2020-01-21 07:30:40', '2020-01-21 07:30:40'),
(17, 'poli', 'levkovich', 207466738, 'polil@gmail.com', '0583398766', '2020-01-21 07:31:25', '2020-01-21 07:31:25'),
(18, 'michal', 'yefet', 672994420, 'michal@gmail.com', '0538266099', '2020-01-21 07:32:14', '2020-01-21 07:32:14'),
(19, 'kobi', 'israel', 937719102, 'kobi@gmail.com', '0548322084', '2020-01-21 07:33:27', '2020-01-21 07:33:27'),
(20, 'tom', 'petrov', 637783372, 'tomp@gmail.com', '0521455428', '2020-01-21 07:34:01', '2020-01-21 07:34:01'),
(21, 'masha', 'kakashka', 634534678, 'masha5@gmail.com', '039324955', '2020-01-29 19:02:42', '2020-02-02 09:54:48');

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `handles`
--

CREATE TABLE `handles` (
  `id` int(11) NOT NULL,
  `headline` text NOT NULL,
  `handle` text NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- הוצאת מידע עבור טבלה `handles`
--

INSERT INTO `handles` (`id`, `headline`, `handle`, `ticket_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'aaaaaaaaa', '<p>aaaaaaaaaaaa</p>', 17, 2, '2020-01-23 00:00:00', '2020-01-23 00:00:00'),
(2, 'bla bla bla', '<p>dfvs fsfsd fs fs fsd fs</p>', 16, 2, '2020-01-27 07:34:07', '2020-01-27 10:41:47'),
(4, 'fd fdf', '<p>daf daf af</p>', 17, 2, '2020-01-27 10:38:55', '2020-01-27 10:39:09'),
(5, 'gfd fsd fsd fsd', '<p>fds fsd fsd</p>', 18, 2, '2020-01-30 12:51:49', '2020-01-30 12:51:49'),
(6, 'gggggg', '<p>gggggds</p>', 18, 2, '2020-01-30 12:52:08', '2020-02-02 07:19:44');

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `subject` text NOT NULL,
  `ticket` text NOT NULL,
  `customer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- הוצאת מידע עבור טבלה `tickets`
--

INSERT INTO `tickets` (`id`, `subject`, `ticket`, `customer_id`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce luctus.', '<ol><li style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec nec enim congue, fringilla ligula vitae, ornare ex. Fusce accumsan magna eget rutrum pellentesque. Nullam sed iaculis risus. Donec in lacus non tortor porttitor sollicitudin nec vel elit. Fusce in augue et turpis cursus porttitor eu quis ante. Quisque venenatis tincidunt mollis. Proin eget lectus et tortor consectetur molestie in eget mauris. Vestibulum tincidunt ex quam. Donec lobortis semper hendrerit. Nullam est mi, eleifend tempus porttitor sit amet, dapibus id enim. Proin molestie dolor metus, ut luctus tellus congue eu. Cras arcu magna, sollicitudin sit amet luctus sit amet, ultrices vitae leo. Donec in laoreet ante.</li><li style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif;\">Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aliquam at molestie elit, eu placerat risus. Aenean nec nunc aliquet, blandit ipsum in, viverra nulla. Cras pharetra consequat tortor id condimentum. Proin tincidunt porttitor sem, ut molestie est elementum nec. Nullam sapien nibh, mollis sit amet ligula ut, porta feugiat risus. Pellentesque molestie est sit amet scelerisque elementum. Duis interdum magna ut posuere faucibus. Etiam tortor libero, ornare quis est in, gravida egestas turpis.</li></ol><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif;\">Vestibulum quam erat, commodo ut metus non, sagittis lobortis quam. Proin ut imperdiet orci, non consequat orci. Aliquam nec imperdiet purus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Aenean aliquet leo ante, at sagittis dolor<b> sollicitudin id. In libero lectus, finibus et tellus sit amet, facilisis ultrices magna. Donec ornare nibh vitae consequat pharetra. Suspendisse u</b>t consectetur massa. Nam efficitur vehicula fringilla. Aliquam erat volutpat. Nulla scelerisque arcu sit amet tincidunt tincidunt. Nam fringilla pellentesque sapien, sed facilisis leo dapibus non. Duis eleifend lectus in dui maximus malesuada. Vestibulum convallis dictum urna vitae porttitor. Curabitur tincidunt neque eget elit rutrum gravida.</p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif;\">Donec eget nunc pretium, sollicitu<span style=\"background-color: rgb(255, 255, 0);\">din risus quis, tristique turpis. Integer vehicula dapibus molestie. Nulla iaculis porttitor augue, vitae lacinia nisi varius sed. Praesent consequat convallis est, in ornare nibh molestie vitae. Suspendisse posuere</span> tellus at purus vestibulum tempus. Suspendisse potenti. Praesent quam massa, bibendum non condimentum nec, ultrices a libero. Praesent ac lacus venenatis lorem congue tempus at at arcu.</p>', 7, 2, 0, '2019-12-20 08:24:41', '2020-01-01 09:44:32'),
(4, 'tellus sed ultrices. Donec ut finibus augue. Proin', '<p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif;\">Nulla a facilisis felis. Morbi sit amet ornare eros. Nunc quis leo a tellus facilisis volutpat. Phasellus nibh nisi, mattis ut faucibus non, tempor ac dolor. Donec cursus malesuada dignissim. In eget feugiat felis. Vestibulum ac justo sed nibh varius porta sit amet a eros. Nunc justo odio, hendrerit eget tortor eu, vehicula gravida felis. Ut vitae sem id magna placerat vehicula. Pellentesque <b>habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Phasellus sit amet sagittis tellus.</b></p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif;\"><b>Vivamus id tincidunt nunc. Aliquam placerat lacus nibh, at scelerisque ligula hendrerit at. Sed pellentesque euismod erat eu ultricies. Proin at erat eu elit lobortis pharetra at in leo. Nunc sodales cursus massa id condimentum. Aliquam enim orci, consectetur vel vulputate eu, pellentesque viverra libero. Suspendisse malesuada fermentum justo et lacinia. Nunc neque urna, vestibulum et ante at, vehicula egestas risus. Integer nec pharetra ipsum. Proin non eleifend velit. Curabitur elementum interdum eleifend. Nunc eu sollicitudin nisi. Donec sed auctor enim. Quisqu</b>e ac elit sit amet mauris tincidunt dignissim.</p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif;\">Morbi nec laoreet nisl. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aenean mattis massa augue, nec euismod dolor vehicula sit amet. Nunc aliquam tristique tellus sed ultrices. Donec ut finibus augue. Proin efficitur purus elit, at ornare felis gravida eget. Cras eu dictum diam, vitae sollicitudin est. Vestibulum finibus augue a dolor feugiat lacinia. Integer rutrum turpis eget nisl accumsan consequat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque ac mattis erat, ut faucibus lectus.</p>', 6, 2, 1, '2019-12-30 08:32:08', '2020-01-29 18:57:03'),
(5, 'Sed semper urna mauris', '<p><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\"><b>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </b>Donec vel gravida ligula. Nam quis luctus arcu, eget venenatis sapien. Integer eleifend consectetur diam at tempor. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Sed semper urna mauris, at eleifend nibh egestas eget. Etiam quis quam ultricies, cursus urna et, aliquet mi. Etiam ut placerat leo, at semper nibh. Proin sollicitudin magna vel elit iaculis dapibus. Maecenas sed suscipit arcu, ac placerat libero. Vestibulum turpis ipsum, cursus et erat eu, auctor iaculis nisl. Quisque et orci mauris. Sed venenatis mi tincidunt semper ullamcorper.</span><br></p>', 9, 2, 1, '2019-12-30 09:12:28', '2020-01-01 09:43:29'),
(16, 'lorem ipsum', '<p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ac pharetra massa. Proin consectetur tempus neque, porttitor sodales velit vehicula at. Nunc efficitur ultrices vulputate. Nulla facilisi. Nulla hendrerit pharetra nulla, vitae porta leo sodales et. Nunc porttitor in risus eu iaculis. Vestibulum metus odio, varius eget elit a, aliquam elementum turpis. Integer vitae vestibulum mauris, et ultrices nisi. Quisque maximus lacus neque, ac condimentum felis rhoncus luctus. Maecenas blandit at tellus eu rhoncus.</p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif;\">Etiam dapibus felis quis mauris tristique fringilla. Suspendisse in consequat odio. Aliquam lectus augue, malesuada in nulla posuere, fermentum fringilla mi. Integer dapibus nulla ac nunc luctus rhoncus. Donec interdum, libero vel fringilla viverra, libero justo imperdiet odio, non suscipit odio ligula ac leo. Suspendisse rutrum ante a nibh congue, ac porta diam sagittis. Etiam vitae eros varius, gravida lectus eget, aliquam tellus. Integer sagittis felis quis magna malesuada, placerat convallis elit vulputate. Ut vehicula feugiat mauris, quis tincidunt diam faucibus at. Ut eu urna ante. Mauris vehicula vulputate odio nec bibendum.</p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif;\">Integer at purus augue. Maecenas tempor arcu id justo molestie vulputate elementum et dui. Duis lectus risus, egestas a turpis at, malesuada vestibulum nisi. Curabitur vulputate felis lectus, a scelerisque ex auctor vel. Vestibulum lectus lectus, placerat ac lacus sed, posuere semper enim. In eleifend lorem metus, ac tempus lorem fringilla eu. Pellentesque sed gravida tellus. Sed et justo eget justo tristique finibus. Praesent lorem metus, molestie vel venenatis in, eleifend et velit.</p>', 20, 2, 0, '2020-01-22 11:48:00', '2020-01-29 08:50:59'),
(7, 'tellus sed us augue. Proin porta sit amet a eros', '<p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif;\">Nulla a facilisis felis. Morbi sit amet ornare eros. Nunc quis leo a tellus facilisis volutpat. Phasellus nibh nisi, mattis ut faucibus non, tempor ac dolor. Donec cursus malesuada dignissim. In eget feugiat felis. Vestibulum ac justo sed nibh varius porta sit amet a eros. Nunc justo odio, hendrerit eget tortor eu, vehicula gravida felis. Ut vitae sem id magna placerat vehicula. Pellentesque <b>habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Phasellus sit amet sagittis tellus/</b></p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif;\">Morbi nec laoreet nisl. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aenean mattis massa augue, nec euismod dolor vehicula sit amet. Nunc aliquam tristique tellus sed ultrices. <u>Donec ut finibus augue. Proin efficitur purus elit, at ornare felis gravida eget. Cras eu dictum diam, vitae sollicitudin est. Vestibulum finibus augue a dolor feugiat lacinia. Integer rutrum turpis eget nisl accumsa</u>n consequat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque ac mattis erat, ut faucibus lectus.</p>', 6, 2, 1, '2020-01-01 09:22:23', '2020-01-11 18:53:43'),
(17, 'fdsgs ds gsg s', '<p>g sgsg sg s</p>', 7, 2, 0, '2020-01-22 12:03:16', '2020-01-29 19:00:31'),
(18, 'Miau mauuuu', '<p>Ksssssssfff</p>', 21, 2, 1, '2020-01-29 19:03:25', '2020-02-02 07:18:20'),
(19, 'dssdsdssaf dsa fsa fsa', '<p>fsaf saf sa fsaf safsa fsa fsafa</p>', 7, 2, 0, '2020-02-02 08:13:17', '2020-02-04 18:39:24'),
(20, 'fdfd fdaf', '<p>df df sdfsd</p>', 7, 2, 1, '2020-02-02 08:14:06', '2020-02-02 08:30:17');

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- הוצאת מידע עבור טבלה `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `role`, `status`, `created_at`, `updated_at`) VALUES
(7, 'asi', 'kapner', 'asik@hvr.co.il', '$2y$10$QEUEoWWa7jdrGA37e9qk6.AdtZQP90qf5FHO7sSML7FASryEoBNxq', 2, 1, '2019-12-17 07:49:21', '2019-12-17 09:01:34'),
(2, 'asi', 'kapner', 'webmas1@gmail.com', '$2y$10$0FP.p1xsnEC4b6wdAqcctuTXsL0Rg3nB/RHsHPtS1Ls29wNWzyRwi', 1, 1, '2019-12-05 04:44:23', '2019-12-17 09:10:54'),
(6, 'pol', 'bogopolsky', 'pol292@gmail.com', '$2y$10$0FP.p1xsnEC4b6wdAqcctuTXsL0Rg3nB/RHsHPtS1Ls29wNWzyRwi', 2, 1, '2019-12-16 05:06:51', '2019-12-17 09:00:45');

--
-- Indexes for dumped tables
--

--
-- אינדקסים לטבלה `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_number` (`id_number`),
  ADD UNIQUE KEY `email` (`email`);

--
-- אינדקסים לטבלה `handles`
--
ALTER TABLE `handles`
  ADD PRIMARY KEY (`id`);

--
-- אינדקסים לטבלה `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- אינדקסים לטבלה `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `handles`
--
ALTER TABLE `handles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
