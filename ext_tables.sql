#
# Table structure for table 'tx_momopreciousmetal_domain_model_pm'
#
CREATE TABLE tx_momopreciousmetal_domain_model_pm (

	date int(11) DEFAULT '0' NOT NULL,
	currency varchar(255) DEFAULT '' NOT NULL,
	xau_price double(11,2) DEFAULT '0.00' NOT NULL,
	xau_close double(11,2) DEFAULT '0.00' NOT NULL,
	xau_open double(11,2) DEFAULT '0.00' NOT NULL,
	xau_change varchar(255) DEFAULT '' NOT NULL,
	xag_price double(11,2) DEFAULT '0.00' NOT NULL,
	xag_close double(11,2) DEFAULT '0.00' NOT NULL,

);
