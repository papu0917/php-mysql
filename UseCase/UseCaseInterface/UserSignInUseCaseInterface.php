<?php

interface UserSignInUseCaseInterface
{
	public function __construct(UserSignInUseCaseInput $input);
	public function handler(): UserSignInUseCaseOutput;
}
