<?php
ALTER TABLE `job_user_prefered_days` ADD `start_time` TIME NULL DEFAULT NULL AFTER `day`, ADD `end_time` TIME NULL DEFAULT NULL AFTER `start_time`;