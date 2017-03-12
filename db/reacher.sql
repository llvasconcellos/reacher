# Banco de Dados reacher Rodando em localhost 
# phpMyAdmin SQL Dump
# version 2.5.4
# http://www.phpmyadmin.net
#
# Servidor: localhost
# Tempo de Generação: Set 02, 2005 at 02:00 PM
# Versão do Servidor: 4.1.0
# Versão do PHP: 4.3.4
# 
# Banco de Dados : `reacher`
# 

# --------------------------------------------------------

#
# Estrutura da tabela `config`
#

CREATE TABLE `config` (
  `cd` int(10) unsigned NOT NULL auto_increment,
  `chave` varchar(255) NOT NULL default '',
  `valor` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`cd`)
);

#
# Extraindo dados da tabela `config`
#

INSERT INTO `config` VALUES (1, 'senha', '123456');
INSERT INTO `config` VALUES (2, 'email_admin', '');
INSERT INTO `config` VALUES (3, 'url_site', '');
INSERT INTO `config` VALUES (4, 'remetente', '');
INSERT INTO `config` VALUES (5, 'email_remetente', '');
INSERT INTO `config` VALUES (6, 'modelo_aniversario', '');
INSERT INTO `config` VALUES (7, 'assunto_email_aniversario', '');
INSERT INTO `config` VALUES (8, 'data_envio_aniversario', '');

# --------------------------------------------------------

#
# Estrutura da tabela `instituicoes`
#

CREATE TABLE `instituicoes` (
  `id_instituicao` int(10) unsigned NOT NULL auto_increment,
  `nome_instituicao` varchar(50) NOT NULL default '',
  `razao_social_instituicao` varchar(50) default NULL,
  `telefone_instituicao` varchar(15) default NULL,
  `fax_instituicao` varchar(15) default NULL,
  `endereco_instituicao` varchar(100) default NULL,
  `bairro_instituicao` varchar(30) default NULL,
  `cidade_instituicao` varchar(30) default NULL,
  `estado_instituicao` char(2) default NULL,
  `cep_instituicao` varchar(8) default NULL,
  PRIMARY KEY  (`id_instituicao`),
  UNIQUE KEY `nome` (`nome_instituicao`)
) TYPE=MyISAM CHARSET=latin1;

#
# Extraindo dados da tabela `instituicoes`
#


# --------------------------------------------------------

#
# Estrutura da tabela `malas`
#

CREATE TABLE `malas` (
  `id_mala` int(10) unsigned NOT NULL auto_increment,
  `nome_mala` varchar(50) NOT NULL default '',
  `assunto_mala` varchar(100) NOT NULL default '',
  `data_mala` date default '2099-12-31',
  `css_mala` text NOT NULL,
  `html_mala` text NOT NULL,
  `status_mala` char(1) NOT NULL default '1',
  PRIMARY KEY  (`id_mala`)
);

#
# Extraindo dados da tabela `malas`
#


# --------------------------------------------------------

#
# Estrutura da tabela `modelos`
#

CREATE TABLE `modelos` (
  `id_modelo` int(10) unsigned NOT NULL auto_increment,
  `nome_modelo` varchar(50) NOT NULL default '',
  `css_modelo` text NOT NULL,
  `html_modelo` text NOT NULL,
  PRIMARY KEY  (`id_modelo`)
);

#
# Extraindo dados da tabela `modelos`
#

# --------------------------------------------------------

#
# Estrutura da tabela `pessoas`
#

CREATE TABLE `pessoas` (
  `id_pessoa` int(10) unsigned NOT NULL auto_increment,
  `id_instituicao` int(10) unsigned NOT NULL default '0',
  `nome_pessoa` varchar(50) NOT NULL default '',
  `telefone_pessoa` varchar(15) default NULL,
  `ramal_pessoa` varchar(5) default NULL,
  `email_pessoa` varchar(50) NOT NULL default '',
  `departamento_pessoa` varchar(30) default NULL,
  `dt_nascimento_pessoa` date default NULL,
  `recebe_email_pessoa` char(1) NOT NULL default 's',
  PRIMARY KEY  (`id_pessoa`),
  UNIQUE KEY `email_pessoa` (`email_pessoa`)
);

#
# Extraindo dados da tabela `pessoas`
#

# --------------------------------------------------------

#
# Estrutura da tabela `segmentos`
#

CREATE TABLE `segmentos` (
  `id_segmento` int(10) unsigned NOT NULL auto_increment,
  `nome_segmento` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`id_segmento`),
  UNIQUE KEY `nome_segmento` (`nome_segmento`)
);

#
# Extraindo dados da tabela `segmentos`
#

# --------------------------------------------------------

#
# Estrutura da tabela `segmentos_instituicoes`
#

CREATE TABLE `segmentos_instituicoes` (
  `id_segmento` int(10) unsigned NOT NULL default '0',
  `id_instituicao` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id_segmento`,`id_instituicao`)
);

#
# Extraindo dados da tabela `segmentos_instituicoes`
#

# --------------------------------------------------------

#
# Estrutura da tabela `segmentos_malas`
#

CREATE TABLE `segmentos_malas` (
  `id_segmento` int(10) unsigned NOT NULL default '0',
  `id_mala` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id_segmento`,`id_mala`)
);

#
# Extraindo dados da tabela `segmentos_malas`
#

# --------------------------------------------------------

#
# Estrutura da tabela `segmentos_pessoas`
#

CREATE TABLE `segmentos_pessoas` (
  `id_segmento` int(10) unsigned NOT NULL default '0',
  `id_pessoa` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id_segmento`,`id_pessoa`)
);

#
# Extraindo dados da tabela `segmentos_pessoas`
#
    