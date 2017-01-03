<?php

function site()
{
	return new \Site;
}

function admin()
{
	return new \Admin;
}

function user()
{
	return auth()->user();
}