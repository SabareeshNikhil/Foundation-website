(function() {  


	//////////////////// STAFF ITEMS
    tinymce.create('tinymce.plugins.staffItems', {  

        init : function(ed, url) {  

            ed.addButton('staffItems', {  

                title : 'Staff Posts',  

                image : url+'/buttons/staff-items.png',  

                onclick : function() {  

                     ed.selection.setContent('[staffItems num_of_posts="3" order="ASC" organiser_title="" /]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('staffItems', tinymce.plugins.staffItems);


	//////////////////// EVENT ITEMS
    tinymce.create('tinymce.plugins.eventItems', {  

        init : function(ed, url) {  

            ed.addButton('eventItems', {  

                title : 'Event Posts',  

                image : url+'/buttons/event-items.gif',  

                onclick : function() {  

                     ed.selection.setContent('[eventItems num_of_posts="2" order="ASC" category="" /]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('eventItems', tinymce.plugins.eventItems);


	////////////////////// SPONSORS CAROUSEL
	tinymce.create('tinymce.plugins.sponsorsCarousel', {  

        init : function(ed, url) {  

            ed.addButton('sponsorsCarousel', {  

                title : 'Sponsors Carousel',  

                image : url+'/buttons/clientCarousel.gif',  

                onclick : function() {  

                     ed.selection.setContent('[sponsorsCarousel controls="true" /]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('sponsorsCarousel', tinymce.plugins.sponsorsCarousel);


	////////////////////// FEATURE BOX
	tinymce.create('tinymce.plugins.featureBox', {  

        init : function(ed, url) {  

            ed.addButton('featureBox', {  

                title : 'Feature Box',  

                image : url+'/buttons/feature-box.gif',  

                onclick : function() {  

                     ed.selection.setContent('[featureBox icon="fa fa-thumbs-o-up" icon_color="#ffffff" title_color="#ffffff" title="Title goes here"]Content goes here[/featureBox]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('featureBox', tinymce.plugins.featureBox);


	//////////////////// POST ITEMS
    tinymce.create('tinymce.plugins.postItems', {  

        init : function(ed, url) {  

            ed.addButton('postItems', {  

                title : 'Post Items',  

                image : url+'/buttons/post-items.gif',  

                onclick : function() {  

                     ed.selection.setContent('[postItems num_of_posts="2" order="ASC" /]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('postItems', tinymce.plugins.postItems);

	//////////////////// STAFF PROFILE
	tinymce.create('tinymce.plugins.staffProfile', {  

        init : function(ed, url) {  

            ed.addButton('staffProfile', {  

                title : 'Staff Profile',  

                image : url+'/buttons/staffProfile.gif',  

                onclick : function() {  

                     ed.selection.setContent('[staffProfile post_id="" icon="fa fa-user" /]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('staffProfile', tinymce.plugins.staffProfile);


	//////////////////// EVENT POST
	
     tinymce.create('tinymce.plugins.eventPost', {  

        init : function(ed, url) {  

            ed.addButton('eventPost', {  

                title : 'Event Post',  

                image : url+'/buttons/event-post.gif',  

                onclick : function() {  

                     ed.selection.setContent('[eventPost id="1" /]');  

  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('eventPost', tinymce.plugins.eventPost); 
	

	////////////////////// BUTTON
	
	tinymce.create('tinymce.plugins.hopeButton', {  

        init : function(ed, url) {  

            ed.addButton('hopeButton', {  

                title : 'Button',  

                image : url+'/buttons/button.gif',  

                onclick : function() {  

                     ed.selection.setContent('[hopeButton color="" textcolor="" type="" url="" target="_self" icon="fa fa-chevron-right"]' + ed.selection.getContent() + '[/hopeButton]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('hopeButton', tinymce.plugins.hopeButton);

	//////////////////////  FEATURED PANEL
	
	tinymce.create('tinymce.plugins.featuredPanel', {  

        init : function(ed, url) {  

            ed.addButton('featuredPanel', {  

                title : 'Featured Column Container',  

                image : url+'/buttons/featured_container.gif',  

                onclick : function() {  

                     ed.selection.setContent('[featuredPanel bgcolor="" bgimage="" border_color="#FFFFFF" class=""]' + ed.selection.getContent() + '[/featuredPanel]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

	tinymce.PluginManager.add('featuredPanel', tinymce.plugins.featuredPanel); 

	////////////////////// DIVIDER
	
	tinymce.create('tinymce.plugins.divider', {  

        init : function(ed, url) {  

            ed.addButton('divider', {  

                title : 'Divider',  

                image : url+'/buttons/divider.gif',  

                onclick : function() {  

                     ed.selection.setContent('[divider height="1" bg_color="orange" margin="20" /]');  
1
                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

	tinymce.PluginManager.add('divider', tinymce.plugins.divider); 

	////////////////////// ALERT
	
	tinymce.create('tinymce.plugins.alert', {  

        init : function(ed, url) {  

            ed.addButton('alert', {  

                title : 'Alert',  

                image : url+'/buttons/alert.png',  

                onclick : function() {  

                     ed.selection.setContent('[alert close="true" type="success"]' + ed.selection.getContent() + '[/alert]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

	tinymce.PluginManager.add('alert', tinymce.plugins.alert); 

	////////////////////// GOOGLE MAP
	
	tinymce.create('tinymce.plugins.googleMap', {  

        init : function(ed, url) {  

            ed.addButton('googleMap', {  

                title : 'Google Map',  

                image : url+'/buttons/google-map.png',  

                onclick : function() {  

                     ed.selection.setContent('[googleMap id="anotherMap" zoom="13" latitude="43.656885" longitude="-79.383904" message="We are here" responsive="1" width="300" height="300" /]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('googleMap', tinymce.plugins.googleMap); 
	

	////////////////////// PANEL HEADER
	
	tinymce.create('tinymce.plugins.panelHeader', {  

        init : function(ed, url) {  

            ed.addButton('panelHeader', {  

                title : 'Panel Header',  

                image : url+'/buttons/panel-header.gif',  

                onclick : function() {  

                     ed.selection.setContent('[panelHeader icon="fa fa-file" link="" target="_self" tip="" bgcolor="orange" marginbottom="10"]' + ed.selection.getContent() + '[/panelHeader]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('panelHeader', tinymce.plugins.panelHeader); 
	
		
	
	//////////////////// PROGRESS BAR
	
     tinymce.create('tinymce.plugins.progressBar', {  

        init : function(ed, url) {  

            ed.addButton('progressBar', {  

                title : 'Progress bar',  

                image : url+'/buttons/progress-bar.gif',  

                onclick : function() {  

                     ed.selection.setContent('[progressBar percentage="50%" type="success" animation="active" /]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('progressBar', tinymce.plugins.progressBar);  
	
	
	//////////////////// SINGLE POST
	
     tinymce.create('tinymce.plugins.singlepost', {  

        init : function(ed, url) {  

            ed.addButton('singlepost', {  

                title : 'Single Post',  

                image : url+'/buttons/single-post.gif',  

                onclick : function() {  

                     ed.selection.setContent('[singlePost id="1" /]');  

  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('singlepost', tinymce.plugins.singlepost); 
	
	
	//////////////////// COLUMN CONTAINER

    tinymce.create('tinymce.plugins.columnContainer', {  

        init : function(ed, url) {  

            ed.addButton('columnContainer', {  

                title : 'Column Container',  

                image : url+'/buttons/cc.gif',  

                onclick : function() {  

                     ed.selection.setContent('[columnContainer fullscreen="off" bgcolor="#FFFFFF" bgimage="" border="yes" class=""]' + ed.selection.getContent() + '[/columnContainer]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('columnContainer', tinymce.plugins.columnContainer);  
	
	
	
	//////////////////// CONTAINER

    /*tinymce.create('tinymce.plugins.container', {  

        init : function(ed, url) {  

            ed.addButton('container', {  

                title : 'Container',  

                image : url+'/buttons/container.gif',  

                onclick : function() {  

                     ed.selection.setContent('[container]' + ed.selection.getContent() + '[/container]');    

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('container', tinymce.plugins.container); */
	
	
	//////////////////// COLUMN


    tinymce.create('tinymce.plugins.column', {  

        init : function(ed, url) {  

            ed.addButton('column', {  

                title : 'Column',  

                image : url+'/buttons/column.gif',  

                onclick : function() {  

                     ed.selection.setContent('[column span="span12" alignment=""]' + ed.selection.getContent() + '[/column]');    

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('column', tinymce.plugins.column); 
	
	
	
	//////////////////// SOCIAL GROUP
	
    tinymce.create('tinymce.plugins.socialGroup', {  

        init : function(ed, url) {  

            ed.addButton('socialGroup', {  

                title : 'Social Group',  

                image : url+'/buttons/icon-group.gif',  

                onclick : function() {  

                     ed.selection.setContent('[socialGroup]<br />[socialIcon icon="fa fa-user" link="#" target="_self" size="5" color="#333333" /]<br />[/socialGroup]');    

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('iconGroup', tinymce.plugins.socialGroup);

	
	
	//////////////////// YOUTUBE

    tinymce.create('tinymce.plugins.youtubeVideo', {  

        init : function(ed, url) {  

            ed.addButton('youtubeVideo', {  

                title : 'Youtube Video',  

                image : url+'/buttons/youtube.png',  

                onclick : function() {  

                     ed.selection.setContent('[youtubeVideo id="0" width="300" height="250" responsive="0" /]');    

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('youtubeVideo', tinymce.plugins.youtubeVideo);
	
	
	
	//////////////////// VIMEO

    tinymce.create('tinymce.plugins.vimeoVideo', {  

        init : function(ed, url) {  

            ed.addButton('vimeoVideo', {  

                title : 'Vimeo Video',  

                image : url+'/buttons/vimeo.png',  

                onclick : function() {  

                     ed.selection.setContent('[vimeoVideo id="0" width="300" height="250" responsive="0" /]');    

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('vimeoVideo', tinymce.plugins.vimeoVideo);
	
	
	//////////////////// HTML5 VIDEO

    /*tinymce.create('tinymce.plugins.html5Video', {  

        init : function(ed, url) {  

            ed.addButton('html5Video', {  

                title : 'HTML5 Video',  

                image : url+'/buttons/html5-video.png',  

                onclick : function() {  

                     ed.selection.setContent('[html5Video webm="" mp4="" ogg=""][/html5Video]');    

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('html5Video', tinymce.plugins.html5Video);*/
	
	
	//////////////////// TAB GROUP

    tinymce.create('tinymce.plugins.tabGroup', {  

        init : function(ed, url) {  

            ed.addButton('tabGroup', {  

                title : 'Tab Group',  

                image : url+'/buttons/tab-group.gif',  

                onclick : function() {  

                     ed.selection.setContent('[tabGroup id="1"]<br />[tabItem title="Tab"]' + ed.selection.getContent() + '[/tabItem]<br />[/tabGroup]');    

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('tabGroup', tinymce.plugins.tabGroup);
	
	
	//////////////////// ACCORDION GROUP

    tinymce.create('tinymce.plugins.accordionGroup', {  

        init : function(ed, url) {  

            ed.addButton('accordionGroup', {  

                title : 'Accordion Group',  

                image : url+'/buttons/accordion.gif',  

                onclick : function() {  

                     ed.selection.setContent('[accordionGroup id="1"]<br />[accordionItem title="Accordion Item 1" icon="fa fa-file"]' + ed.selection.getContent() + '[/accordionItem]<br />[/accordionGroup]');    

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('accordionGroup', tinymce.plugins.accordionGroup);

	
	
	//////////////////// TESTIMONIALS
    /*tinymce.create('tinymce.plugins.testimonials', {  

        init : function(ed, url) {  

            ed.addButton('testimonials', {  

                title : 'Testimonials',  

                image : url+'/buttons/testimonials.gif',  

                onclick : function() {  

                     ed.selection.setContent('[testimonials /]');    

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('testimonials', tinymce.plugins.testimonials);*/
	
	
	//////////////////// CONTACT FORM
    /*tinymce.create('tinymce.plugins.contactForm', {  

        init : function(ed, url) {  

            ed.addButton('contactForm', {  

                title : 'Contact Form',  

                image : url+'/buttons/contact-form.gif',  

                onclick : function() {  

                     ed.selection.setContent('[contactForm title="Contact Form" email_address="name@yourdomain.com" button_text="Send Message" icon="fa fa-mail-forward" button_size="medium" paddingtop="40" paddingbottom="40" /]');    

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('contactForm', tinymce.plugins.contactForm);*/
	
	
	//////////////////// IMAGE PANEL

    tinymce.create('tinymce.plugins.imagePanel', {  

        init : function(ed, url) {  

            ed.addButton('imagePanel', {  

                title : 'Image Panel',  

                image : url+'/buttons/image-panel.gif',  

                onclick : function() {  

                     ed.selection.setContent('[imagePanel tip="" icon="fa fa-file" hover_icon="fa fa-link" title="" link="" image="" /]');   

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('imagePanel', tinymce.plugins.imagePanel);

    
})();  