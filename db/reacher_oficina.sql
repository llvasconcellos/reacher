-- phpMyAdmin SQL Dump
-- version 2.8.2.4
-- http://www.phpmyadmin.net
-- 
-- Servidor: localhost:3306
-- Tempo de Geração: Jul 03, 2010 as 09:32 PM
-- Versão do Servidor: 5.0.45
-- Versão do PHP: 5.2.3
-- 
-- Banco de Dados: `reacher_oficina`
-- 

-- --------------------------------------------------------

-- 
-- Estrutura da tabela `config_reacher`
-- 

CREATE TABLE `config_reacher` (
  `cd` int(10) unsigned NOT NULL auto_increment,
  `chave` varchar(255) collate latin1_general_ci NOT NULL default '',
  `valor` varchar(255) collate latin1_general_ci NOT NULL default '',
  PRIMARY KEY  (`cd`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=11 ;

-- 
-- Extraindo dados da tabela `config_reacher`
-- 

INSERT INTO `config_reacher` (`cd`, `chave`, `valor`) VALUES (1, 'senha', 'newlife2008'),
(2, 'email_admin', 'marcia@oficinadossonhos.com.br'),
(3, 'url_site', 'http://oficina.devhouse.com.br'),
(4, 'remetente', 'Oficina dos Sonhos'),
(5, 'email_remetente', 'marcia@oficinadossonhos.com.br'),
(6, 'modelo_aniversario', '20'),
(7, 'assunto_email_aniversario', 'Feliz Aniversário!'),
(8, 'data_envio_aniversario', '03/07/2010'),
(9, 'lixo', '50'),
(10, 'return-path', 'oficina@devhouse.com.br');

-- --------------------------------------------------------

-- 
-- Estrutura da tabela `instituicoes`
-- 

CREATE TABLE `instituicoes` (
  `id_instituicao` int(10) unsigned NOT NULL auto_increment,
  `nome_instituicao` varchar(50) collate latin1_general_ci NOT NULL default '',
  `razao_social_instituicao` varchar(50) collate latin1_general_ci default NULL,
  `telefone_instituicao` varchar(15) collate latin1_general_ci default NULL,
  `fax_instituicao` varchar(15) collate latin1_general_ci default NULL,
  `endereco_instituicao` varchar(100) collate latin1_general_ci default NULL,
  `bairro_instituicao` varchar(30) collate latin1_general_ci default NULL,
  `cidade_instituicao` varchar(30) collate latin1_general_ci default NULL,
  `estado_instituicao` char(2) collate latin1_general_ci default NULL,
  `cep_instituicao` varchar(8) collate latin1_general_ci default NULL,
  PRIMARY KEY  (`id_instituicao`),
  UNIQUE KEY `nome` (`nome_instituicao`)
) ENGINE=MyISAM AUTO_INCREMENT=2037 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2037 ;

-- 
-- Extraindo dados da tabela `instituicoes`
-- 


-- --------------------------------------------------------

-- 
-- Estrutura da tabela `lembretes`
-- 

CREATE TABLE `lembretes` (
  `id_lembrete` int(10) unsigned NOT NULL auto_increment,
  `titulo` varchar(255) collate latin1_general_ci NOT NULL default '',
  `destinatario` varchar(255) collate latin1_general_ci NOT NULL default '',
  `texto` text collate latin1_general_ci NOT NULL,
  `data` varchar(12) collate latin1_general_ci NOT NULL default '0000-00-00',
  `status` tinyint(4) NOT NULL default '1',
  `ultimo_envio` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`id_lembrete`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=5 ;

-- 
-- Extraindo dados da tabela `lembretes`
-- 

INSERT INTO `lembretes` (`id_lembrete`, `titulo`, `destinatario`, `texto`, `data`, `status`, `ultimo_envio`) VALUES (3, 'Exemplo de Lembrete', 'leonardo@devhouse.com.br', 'Exemplo de Lembrete gerado pelo Reacher Mailer Oficina dos Sonhos.<br>\r\nProgramado para ser enviado todos os dias.', 'W;*', 1, '2010-03-11'),
(4, 'Lembrete', 'leonardo.vasconcellos@gmail.com', 'bla bla bla<br>', 'W;*', 1, '2010-03-11');

-- --------------------------------------------------------

-- 
-- Estrutura da tabela `malas`
-- 

CREATE TABLE `malas` (
  `id_mala` int(10) unsigned NOT NULL auto_increment,
  `nome_mala` varchar(50) collate latin1_general_ci NOT NULL default '',
  `remetente_mala` varchar(255) collate latin1_general_ci default NULL,
  `assunto_mala` varchar(100) collate latin1_general_ci NOT NULL default '',
  `data_mala` date default '2099-12-31',
  `css_mala` text collate latin1_general_ci NOT NULL,
  `txt_mala` text collate latin1_general_ci NOT NULL,
  `html_mala` text collate latin1_general_ci NOT NULL,
  `status_mala` char(1) collate latin1_general_ci NOT NULL default '1',
  `emails_enviados` bigint(20) NOT NULL default '0',
  `bounces` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`id_mala`)
) ENGINE=MyISAM AUTO_INCREMENT=162 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=162 ;

-- 
-- Extraindo dados da tabela `malas`
-- 

INSERT INTO `malas` (`id_mala`, `nome_mala`, `remetente_mala`, `assunto_mala`, `data_mala`, `css_mala`, `txt_mala`, `html_mala`, `status_mala`, `emails_enviados`, `bounces`) VALUES (161, 'Oficina dos Sonhos', 'oficina@devhouse.com.br', 'Teste de envio', '2010-03-12', '', 'Prezados Pais,\r\n\r\nPara melhor atendê-los, informamos que a cantina e restaurante da escola foi terceirizado.\r\nToda a alimentação aos alunos será fornecida por "Oficina do Sabor" que irá servir lanches, almoço e sopas seguindo todo o cardápio da escola.\r\nOs pais que não contratarem as refeições na secretaria da escola mensalmente, deverão negociar diretamente com a cantina os lanches e almoços avulsos.\r\nSomente poderemos cobrar no boleto da mensalidade, as refeições contratadas mensalmente.\r\nEstamos buscando todas as melhorias possíveis.\r\nAgradecemos a compreensão,\r\n\r\nMárcia Poletti - 26/02/2010', 'Prezados Pais,<br><br>Para melhor atendê-los, informamos que a cantina e restaurante da escola foi terceirizado.<br>Toda a alimentação aos alunos será fornecida por "Oficina do Sabor" que irá servir lanches, almoço e sopas seguindo todo o cardápio da escola.<br>Os pais que não contratarem as refeições na secretaria da escola mensalmente, deverão negociar diretamente com a cantina os lanches e almoços avulsos.<br>Somente poderemos cobrar no boleto da mensalidade, as refeições contratadas mensalmente.<br>Estamos buscando todas as melhorias possíveis.<br>Agradecemos a compreensão,<br><br>Márcia Poletti - 26/02/2010<br>', '2', 9, 0),
(157, 'Oficina dos Sonhos', 'oficina@devhouse.com.br', 'Nova Cantina', '2010-03-12', '', 'Prezados Pais,\r\n\r\nPara melhor atendê-los, informamos que a cantina e restaurante da escola foi terceirizado.\r\nToda a alimentação aos alunos será fornecida por "Oficina do Sabor" que irá servir lanches, almoço e sopas seguindo todo o cardápio da escola.\r\nOs pais que não contratarem as refeições na secretaria da escola mensalmente, deverão negociar diretamente com a cantina os lanches e almoços avulsos.\r\nSomente poderemos cobrar no boleto da mensalidade, as refeições contratadas mensalmente.\r\nEstamos buscando todas as melhorias possíveis.\r\nAgradecemos a compreensão,\r\n\r\nMárcia Poletti - 26/02/2010', '<img alt="Cantina" src="http://oficina.devhouse.com.br/img/bilhete%20terceirizar%20cantina.JPG" align="" border="0px">', '2', 9, 0);

-- --------------------------------------------------------

-- 
-- Estrutura da tabela `malas_envios`
-- 

CREATE TABLE `malas_envios` (
  `id_mala` bigint(20) unsigned NOT NULL,
  `email` varchar(255) collate latin1_general_ci NOT NULL,
  `ordem` bigint(20) NOT NULL,
  KEY `id_mala` (`id_mala`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Extraindo dados da tabela `malas_envios`
-- 

INSERT INTO `malas_envios` (`id_mala`, `email`, `ordem`) VALUES (161, 'rlvasconcellos@hotmail.com', 9),
(161, 'rlvasconcellos@gmail.com', 8),
(157, 'rlvasconcellos@hotmail.com', 9),
(161, 'denise_lv@ig.com.br', 7),
(161, 'deniselima@prsc.mpf.gov.br', 6),
(161, 'leo_lima_jlle@yahoo.com.br', 5),
(161, 'leonardo.vasconcellos@gmail.com', 4),
(161, 'leonardo@devhouse.com.br', 3),
(161, 'leo.lima.web@gmail.com', 2),
(161, 'denisejlle@hotmail.com', 1),
(157, 'rlvasconcellos@gmail.com', 8),
(157, 'denise_lv@ig.com.br', 7),
(157, 'deniselima@prsc.mpf.gov.br', 6),
(157, 'leo_lima_jlle@yahoo.com.br', 5),
(157, 'leonardo.vasconcellos@gmail.com', 4),
(157, 'leonardo@devhouse.com.br', 3),
(157, 'leo.lima.web@gmail.com', 2),
(157, 'denisejlle@hotmail.com', 1);

-- --------------------------------------------------------

-- 
-- Estrutura da tabela `malas_visualizacoes`
-- 

CREATE TABLE `malas_visualizacoes` (
  `id_mala` int(10) unsigned NOT NULL,
  `id_pessoa` int(10) unsigned NOT NULL,
  KEY `id_mala` (`id_mala`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Extraindo dados da tabela `malas_visualizacoes`
-- 


-- --------------------------------------------------------

-- 
-- Estrutura da tabela `modelos`
-- 

CREATE TABLE `modelos` (
  `id_modelo` int(10) unsigned NOT NULL auto_increment,
  `nome_modelo` varchar(50) collate latin1_general_ci NOT NULL default '',
  `css_modelo` text collate latin1_general_ci NOT NULL,
  `html_modelo` text collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`id_modelo`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=21 ;

-- 
-- Extraindo dados da tabela `modelos`
-- 

INSERT INTO `modelos` (`id_modelo`, `nome_modelo`, `css_modelo`, `html_modelo`) VALUES (20, 'Aniversário', 'body{margin:0; background-color:#cccccc; font-family:Verdana, Geneva, sans-serif;font-size:12px}', '<center><div style="padding: 10px; width: 700px; height: 100px; background-color: rgb(200, 43, 50); vertical-align: middle;"><img src="http://oficina.devhouse.com.br/img/colegio_oficina.png" align="left" hspace="20"><img src="http://oficina.devhouse.com.br/img/oficina_dos_sonhos.png" align="right" hspace="20"></div><div style="clear:both"></div><div style="padding: 10px; width: 700px; background-color: rgb(255, 255, 255); text-align: left;">Olá {nome},<br><br>A equipe do Colégio Oficina deseja a você um feliz aniversário!<br><br><br><center><img src="http://oficina.devhouse.com.br/img/pb.jpg"></center><br><br><br></div><div style="clear:both"></div><div style="border: 1px solid rgb(204, 204, 204); width: 700px; height: 100px; background-color: rgb(235, 244, 255); vertical-align: middle; text-align: center;"><h3 style="margin: 30px; color: rgb(51, 51, 51); float: left;">(47) 3425-5063</h3><h3 style="margin: 30px; color: rgb(51, 51, 51); float: right;"><a style="color: rgb(51, 51, 51); text-decoration: none;" target="_blank" href="http://www.oficinadossonhos.com.br">www.oficinadossonhos.com.br</a></h3></div><div style="padding: 10px; width: 700px; text-align: center; font-size: 10px;">Rua Rudolf Plotow, 296 - Costa e Silva - Joinville - Santa Catarina<br>Copyright © 2005 - 2010 Oficina dos Sonhos.</div></center>');

-- --------------------------------------------------------

-- 
-- Estrutura da tabela `pessoas`
-- 

CREATE TABLE `pessoas` (
  `id_pessoa` int(10) unsigned NOT NULL auto_increment,
  `id_instituicao` int(10) unsigned NOT NULL default '0',
  `nome_pessoa` varchar(50) collate latin1_general_ci NOT NULL default '',
  `telefone_pessoa` varchar(20) collate latin1_general_ci default NULL,
  `ramal_pessoa` varchar(5) collate latin1_general_ci default NULL,
  `celular_pessoa` varchar(20) collate latin1_general_ci default NULL,
  `email_pessoa` varchar(255) collate latin1_general_ci NOT NULL default '',
  `departamento_pessoa` varchar(30) collate latin1_general_ci default NULL,
  `dt_nascimento_pessoa` date default NULL,
  `recebe_email_pessoa` char(1) collate latin1_general_ci NOT NULL default 's',
  `dt_nao_recebe_email` datetime default NULL,
  `motivo` smallint(6) default NULL,
  PRIMARY KEY  (`id_pessoa`),
  UNIQUE KEY `email_pessoa` (`email_pessoa`),
  KEY `id_instituicao` (`id_instituicao`)
) ENGINE=MyISAM AUTO_INCREMENT=84951 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=84951 ;

-- 
-- Extraindo dados da tabela `pessoas`
-- 

INSERT INTO `pessoas` (`id_pessoa`, `id_instituicao`, `nome_pessoa`, `telefone_pessoa`, `ramal_pessoa`, `celular_pessoa`, `email_pessoa`, `departamento_pessoa`, `dt_nascimento_pessoa`, `recebe_email_pessoa`, `dt_nao_recebe_email`, `motivo`) VALUES (84942, 0, 'Denise Alcântara Bezerra de Lima', '(47) 3026-6908', '', '(47) 9961-0414', 'denisejlle@hotmail.com', 'Jurídico', '1955-01-19', 's', NULL, NULL),
(84943, 0, 'Leonardo Lima de Vasconcellos', '(47) 3026-6908', '', '(47) 9944-2321', 'leo.lima.web@gmail.com', '', '1978-01-13', 's', NULL, NULL),
(84944, 0, 'Leonardo Lima de Vasconcellos', '(47) 3026-6908', '', '(47) 9944-2321', 'leonardo@devhouse.com.br', '', '1978-01-13', 's', NULL, NULL),
(84945, 0, 'Leonardo Lima de Vasconcellos', '(47) 3026-6908', '', '(47) 9944-2321', 'leonardo.vasconcellos@gmail.com', '', '1978-03-01', 's', NULL, NULL),
(84946, 0, 'Leonardo Lima de Vasconcellos', '(47) 3026-6908', '', '(47) 9944-2321', 'leo_lima_jlle@yahoo.com.br', '', '1978-01-13', 's', NULL, NULL),
(84947, 0, 'Denise Alcântara Bezerra de Lima', '(47) 3026-6908', '', '(47) 9961-0414', 'deniselima@prsc.mpf.gov.br', '', '1955-07-19', 's', NULL, NULL),
(84948, 0, 'Denise Alcântara Bezerra de Lima', '(47) 3026-6908', '', '(47) 9961-0414', 'denise_lv@ig.com.br', '', '1955-07-19', 's', NULL, NULL),
(84949, 0, 'Rafael Lima de Vasconcellos', '(47) 3026-6908', '', '(47) 9961-0414', 'rlvasconcellos@gmail.com', '', '1980-11-15', 's', NULL, NULL),
(84950, 0, 'Rafael Lima de Vasconcellos', '(47) 3026-6908', '', '(47) 9944-2321', 'rlvasconcellos@hotmail.com', '', '1980-11-15', 's', NULL, NULL);

-- --------------------------------------------------------

-- 
-- Estrutura da tabela `segmentos`
-- 

CREATE TABLE `segmentos` (
  `id_segmento` int(10) unsigned NOT NULL auto_increment,
  `nome_segmento` varchar(50) collate latin1_general_ci NOT NULL default '',
  PRIMARY KEY  (`id_segmento`),
  UNIQUE KEY `nome_segmento` (`nome_segmento`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=46 ;

-- 
-- Extraindo dados da tabela `segmentos`
-- 

INSERT INTO `segmentos` (`id_segmento`, `nome_segmento`) VALUES (45, 'Testes de Envio');

-- --------------------------------------------------------

-- 
-- Estrutura da tabela `segmentos_instituicoes`
-- 

CREATE TABLE `segmentos_instituicoes` (
  `id_segmento` int(10) unsigned NOT NULL default '0',
  `id_instituicao` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id_segmento`,`id_instituicao`),
  KEY `id_segmento` (`id_segmento`),
  KEY `id_instituicao` (`id_instituicao`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Extraindo dados da tabela `segmentos_instituicoes`
-- 


-- --------------------------------------------------------

-- 
-- Estrutura da tabela `segmentos_malas`
-- 

CREATE TABLE `segmentos_malas` (
  `id_segmento` int(10) unsigned NOT NULL default '0',
  `id_mala` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id_segmento`,`id_mala`),
  KEY `id_segmento` (`id_segmento`),
  KEY `id_mala` (`id_mala`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Extraindo dados da tabela `segmentos_malas`
-- 

INSERT INTO `segmentos_malas` (`id_segmento`, `id_mala`) VALUES (45, 157),
(45, 161);

-- --------------------------------------------------------

-- 
-- Estrutura da tabela `segmentos_pessoas`
-- 

CREATE TABLE `segmentos_pessoas` (
  `id_segmento` int(10) unsigned NOT NULL default '0',
  `id_pessoa` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id_segmento`,`id_pessoa`),
  KEY `id_segmento` (`id_segmento`),
  KEY `id_pessoa` (`id_pessoa`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Extraindo dados da tabela `segmentos_pessoas`
-- 

INSERT INTO `segmentos_pessoas` (`id_segmento`, `id_pessoa`) VALUES (45, 84942),
(45, 84943),
(45, 84944),
(45, 84945),
(45, 84946),
(45, 84947),
(45, 84948),
(45, 84949),
(45, 84950);
