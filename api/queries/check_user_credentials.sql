select
	'1'
from
	users
where
	users.username     = :username
	and users.password = :password