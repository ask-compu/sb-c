!function(e){function a(){i=!1;for(var a=0;a<t.length;a++){var n=e(t[a]).filter(function(){return e(this).is(":appeared")});if(n.trigger("appear",[n]),r){var p=r.not(n);p.trigger("disappear",[p])}r=n}}var r,t=[],n=!1,i=!1,p={interval:250,force_process:!1},o=e(window);e.expr[":"].appeared=function(a){var r=e(a);if(!r.is(":visible"))return!1;var t=o.scrollLeft(),n=o.scrollTop(),i=r.offset(),p=i.left,c=i.top;return c+r.height()>=n&&c-(r.data("appear-top-offset")||0)<=n+o.height()&&p+r.width()>=t&&p-(r.data("appear-left-offset")||0)<=t+o.width()?!0:!1},e.fn.extend({appear:function(r){var o=e.extend({},p,r||{}),c=this.selector||this;if(!n){var f=function(){i||(i=!0,setTimeout(a,o.interval))};e(window).scroll(f).resize(f),n=!0}return o.force_process&&setTimeout(a,o.interval),t.push(c),e(c)}}),e.extend({force_appear:function(){return n?(a(),!0):!1}})}(jQuery),function(e){e.fn.appear1=function(a,r){var t=e.extend({data:void 0,one:!0,accX:0,accY:0},r);return this.each(function(){var r=e(this);if(r.appeared=!1,!a)return void r.trigger("appear1",t.data);var n=e(window),i=function(){if(!r.is(":visible"))return void(r.appeared=!1);var e=n.scrollLeft(),a=n.scrollTop(),i=r.offset(),p=i.left,o=i.top,c=t.accX,f=t.accY,s=r.height(),u=n.height(),l=r.width(),d=n.width();o+s+f>=a&&a+u+f>=o&&p+l+c>=e&&e+d+c>=p?r.appeared||r.trigger("appear1",t.data):r.appeared=!1},p=function(){if(r.appeared=!0,t.one){n.unbind("scroll",i);var p=e.inArray(i,e.fn.appear.checks);p>=0&&e.fn.appear.checks.splice(p,1)}a.apply(this,arguments)};t.one?r.one("appear1",t.data,p):r.bind("appear1",t.data,p),n.scroll(i),e.fn.appear1.checks.push(i),i()})},e.extend(e.fn.appear1,{checks:[],timeout:null,checkAll:function(){var a=e.fn.appear1.checks.length;if(a>0)for(;a--;)e.fn.appear1.checks[a]()},run:function(){e.fn.appear1.timeout&&clearTimeout(e.fn.appear1.timeout),e.fn.appear1.timeout=setTimeout(e.fn.appear1.checkAll,20)}})}(jQuery);