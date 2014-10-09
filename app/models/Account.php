<?php
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Account extends \Eloquent implements UserInterface, RemindableInterface
{
	protected $hidden = array('password');
	
	public function getAuthIdentifier()
    {
        return $this->getKey();
    }
	
	public function getReminderEmail()
	{
		return $this->email;
	}

    public function getAuthPassword()
    {
        return $this->password;
    }
	
	 public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
       $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }
	
	//-------------------Auth sampai Disini......woooooooo

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];

	public function profile()
    {
        return $this->belongsTo('Profile');
    }

    public function transaction()
    {
    	return $this->hasMany('Transaction');
    }

    public function supportTicket()
    {
    	return $this->hasMany('SupportTicket');
    }

    public function wishlist()
    {
    	return $this->hasMany('Wishlist');
    }

    public function log()
    {
    	return $this->hasMany('Log');
    }

    public function cart()
    {
    	return $this->hasMany('Cart');
    }
}