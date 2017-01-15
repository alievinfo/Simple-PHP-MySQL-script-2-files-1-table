CREATE TABLE `m_simple_script` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

ALTER TABLE `m_simple_script`
  ADD PRIMARY KEY (`id`);
  
ALTER TABLE `m_simple_script`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

  