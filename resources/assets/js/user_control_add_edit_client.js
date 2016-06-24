class Client{

    accessControlInit(){
        $(".access-enable").on('click', function (e) {
            $(".access").removeClass('ticked');
            $(this).addClass("ticked");
            $("#user-access").val('enabled');
            $(".message.disabled-message").slideUp();
        });

        $(".access-disable").on('click', function (e) {
            $(".access").removeClass('ticked');
            $(this).addClass("ticked");
            $("#user-access").val('disabled');
            $(".message.disabled-message").slideDown();
        });
    }

    updateAccessInit(){
        $(".accessUpdateBtn").on('click', function(){
            var client_id = $("#client-id").val(),
                access = $("#user-access").val(),
                token = $("meta[name=_token]").attr('content');
            console.log(token);

            $.ajax({
                url : '/dashboard/user-control/update/access',
                type : 'POST',

                data : {
                    client : client_id,
                    access : access,
                    _token : token
                },
                success : function(res){
                    if(res.updated){
                        window.location = '/dashboard/user-control/user-list';
                    }
                }
            });

            console.log(client_id, access);
        });
    }

    /**
     * Get Name
     * @returns {*}
     */
    getName(){
        return $.trim(this.name.val());
    }

    /**
     * Get Company
     * @returns {*}
     */
    getCompany(){
        return $.trim(this.company.val());
    }

    /**
     * Get Card Identifier
     * @returns {*}
     */
    getCardIdentifier(){
        return $.trim(this.card_identifier.val());
    }

    /**
     * Get enotes
     * @returns {*}
     */
    getENotes(){
        return $.trim(this.enotes.val());
    }

    /**
     * Get Date
     * @returns {*}
     */
    getDate(){
        return $.trim(this.date.val());
    }

    /**
     * Get User Access
     * @returns {*}
     */
    getUserAccess(){
        return $.trim(this.user_access.val());
    }

    /**
     * Validate form
     * @returns {*}
     */
    allValid(){
        return (this.getName().length &&
                this.getCompany().length &&
                this.getCardIdentifier().length &&
                this.getDate() &&
                this.getUserAccess()
        );
    }

    createClient(_this){
        $.ajax({
            type : 'POST',
            url : '/dashboard/user-control/create',
            data : {
                name : _this.getName(),
                company : _this.getCompany(),
                date : _this.getDate(),
                card_identifier : _this.getCardIdentifier(),
                user_access : _this.getENotes(),
                access : _this.getUserAccess(),
                _token : $("meta[name=_token]").attr('content')
            },
            success : function(res){
                if(res){
                    window.location = '/dashboard/user-control/user-list';
                }
            }
        });
    }

    
    validateTag(tag, _this){
        $.ajax({
            type : 'GET',
            url : '/dashboard/user-control/exist',
            data : {
                tag : tag
            },
            success : function(tag){
                if(tag){
                    _this.card_identifier.after(_this.errorDOM('Tag already exist')).addClass('invalid');
                }else{
                    _this.createClient(_this);
                }
            }
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
            _this.validateTag(_this.getCardIdentifier(),_this);
        }else{

            if(!_this.getName().length){
                _this.name.after(_this.errorDOM('Missing data')).addClass('invalid');
            }

            if(!_this.getCompany().length){
                _this.company.after(_this.errorDOM('Missing data')).addClass('invalid');
            }

            if(!_this.getCardIdentifier().length){
                _this.card_identifier.after(_this.errorDOM('Missing data')).addClass('invalid');
            }

            if(!_this.getDate().length){
                _this.date.after(_this.errorDOM('Missing data')).addClass('invalid');
            }

        }
    }
    
    

    constructor(){

        this.name = $("#name");
        this.company = $("#company");
        this.date = $("#uc-date");
        this.card_identifier = $("#card-identifier");
        this.enotes = $("#enotes");
        this.user_access = $("#user-access");

        this.updateAccessInit();
        this.accessControlInit();
        $("#uc-date").datepicker({ dateFormat: 'yy-mm-dd' });

        $(".user-control .add-user-form form").on('submit', {context : this}, this.validateForm);
        $("#name, #company, #uc-date, #card-identifier, #enotes").on('keyup change', function(){
            $(this).siblings(".invalid-input-tooltip").remove();
            $(this).removeClass('invalid');
        });
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

new Client();