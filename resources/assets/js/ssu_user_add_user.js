class ssuUser{

    constructor(){

        this.email = $("#email");
        this.password = $("#password");
        this.confirm_password = $("#password-confirm");

        $(".manage-super-user .add-user-form form").on('submit', {context : this}, this.validateForm);
        $("#email, #password, #password-confirm").on('keyup change', function(){
            $(this).siblings(".invalid-input-tooltip").remove();
            $(this).removeClass('invalid');
        });
    }

    /**
     * Validate form fields
     * @param e
     */
    validateForm(e){
        e.preventDefault();
        var _this = e.data.context;
        $(".invalid-input-tooltip").remove();

        if(_this.allValid()){
            if(_this.getPassword().length > 6){
                if(_this.getPassword() === _this.getConfirmPassword()) {
                    _this.validateEmail(_this.getEmail(), _this);
                }else{
                    _this.password.after(_this.errorDOM("Passwords didn't match")).addClass('invalid');
                }
            }else{
                _this.password.after(_this.errorDOM('6 characters minimum')).addClass('invalid');
            }
        }else{

            if(!_this.getEmail().length){
                _this.email.after(_this.errorDOM('Missing data')).addClass('invalid');
            }

            if(!_this.getPassword().length){
                _this.password.after(_this.errorDOM('Missing data')).addClass('invalid');
            }

            if(!_this.getConfirmPassword().length){
                _this.confirm_password.after(_this.errorDOM('Missing data')).addClass('invalid');
            }


        }
    }

    /**
     * Checks for duplicate emails
     * @param email
     * @param _this
     */
    validateEmail(email, _this){
        $.ajax({
            type : 'GET',
            url : '/dashboard/manage/super-users/exists',
            data : {
                email : email
            },
            success : function(user){
                if(user){
                    _this.email.after(_this.errorDOM('Email already exist')).addClass('invalid');
                }else{
                    _this.createAdmin(_this);
                }
            }
        });
    }

    /**
     * Create a new admin
     * @param _this
     */
    createAdmin(_this){
        $.ajax({
            type : 'POST',
            url : '/dashboard/manage/super-users/create',
            data : {
                email : _this.getEmail(),
                password : _this.getPassword(),
                _token : $("meta[name=_token]").attr('content')
            },
            success : function(res){
                if(res){

                    window.location = '/dashboard/manage/super-users/users-list';
                }
            }
        });
    }

    /**
     * Get Email
     * @returns {*}
     */
    getEmail(){
        return $.trim(this.email.val());
    }

    /**
     * Get Password
     * @returns {*}
     */
    getPassword(){
        return $.trim(this.password.val());
    }
    
    getConfirmPassword(){
        return $.trim(this.confirm_password.val());
    }

    /**
     * Validate form
     * @returns {*}
     */
    allValid(){
        return (this.getEmail().length &&
                this.getPassword().length &&
                this.getConfirmPassword().length);
    }

    /**
     * Generates Error DOM
     * @param message
     * @returns {string}
     */
    errorDOM(message){
        return `<?xml version="1.0" encoding="utf-8"?>
                <!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
                <svg version="1.1" class="invalid-input-tooltip" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                     viewBox="0 0 91 16" enable-background="new 0 0 91 16" xml:space="preserve">
                <g>
                    <rect x="4" fill="#C1354E" width="87" height="16"/>
                    <g>
                        <g>
                            <path fill="#FFFFFF" d="M13.7,9.5c0-0.1,0-0.2,0.1-0.3l0.5-1.8c0,0,0,0,0-0.1c0,0,0,0,0-0.1c0-0.1,0-0.2-0.1-0.2
                                C14.1,7,14,7,13.8,7V6.7c0.2,0,0.4,0,0.7-0.1c0.3,0,0.5-0.1,0.6-0.1l0.3-0.1l-0.6,2.3c-0.1,0.2-0.1,0.3-0.1,0.4
                                c0,0.2-0.1,0.3-0.1,0.4c0,0.1,0,0.1,0,0.1c0,0,0.1,0,0.1,0c0.1,0,0.2-0.1,0.3-0.2c0.1-0.1,0.2-0.3,0.3-0.4l0.2,0.1
                                C15.3,9.6,15.1,9.9,15,10c-0.2,0.2-0.5,0.3-0.7,0.3c-0.1,0-0.3,0-0.4-0.1c-0.1-0.1-0.2-0.2-0.2-0.4C13.6,9.7,13.7,9.6,13.7,9.5z
                                 M15.6,4.9c0.1,0.1,0.2,0.2,0.2,0.4s-0.1,0.3-0.2,0.4c-0.1,0.1-0.2,0.2-0.4,0.2s-0.3-0.1-0.4-0.2c-0.1-0.1-0.2-0.2-0.2-0.4
                                s0.1-0.3,0.2-0.4c0.1-0.1,0.2-0.2,0.4-0.2S15.5,4.8,15.6,4.9z"/>
                        </g>
                        <g>
                            <path fill="#FFFFFF" d="M14.7,2.9C12,2.9,9.8,5,9.8,7.7c0,2.7,2.2,4.9,4.9,4.9c2.7,0,4.9-2.2,4.9-4.9C19.6,5,17.4,2.9,14.7,2.9z
                                 M14.7,11.9c-2.3,0-4.1-1.9-4.1-4.1c0-2.3,1.9-4.1,4.1-4.1c2.3,0,4.1,1.9,4.1,4.1C18.8,10,17,11.9,14.7,11.9z"/>
                        </g>
                    </g>
                    <polygon fill="#D2304F" points="-0.3,7.5 1.9,6.3 4,5.1 4,7.5 4,9.9 1.9,8.7 	"/>
                    <text transform="matrix(0.9919 0 0 1 23.0004 10.3691)" fill="#FFFFFF">${message}</text>
                </g>
                </svg>`;
    }
}

new ssuUser();