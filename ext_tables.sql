#
# Table structure for table 'fe_users'
#
CREATE TABLE fe_users (
	tx_oidc varchar(100) DEFAULT '' NOT NULL,
	access_token varchar(1000) DEFAULT '' NOT NULL,
	refresh_token varchar(100) DEFAULT '',
	KEY fk_oidc (tx_oidc)
);

#
# Table structure for table 'fe_groups'
#
CREATE TABLE fe_groups (
	tx_oidc_pattern varchar(255) DEFAULT '' NOT NULL
);
