
"use strict";
(
    function(a)
    {
        'function'==typeof define&&define.amd?define(['jquery','tinysort'],a):jQuery&&!jQuery.fn.tsort&&a(jQuery,tinysort)
    }
)
(
    function(a,b)
    {
        a.tinysort={defaults:b.defaults},a.fn.extend(
        {
            tinysort:function(a)
            {
                function b()
                {
                    return a.apply(this,arguments)
                }
                return b.toString=function()
                {
                    return a.toString()
                },
                b
            }
            (function()
            {
                for(var a=arguments.length,c=Array(a),d=0;d<a;d++)
                    c[d]=arguments[d];
                for(var e=b.apply(void 0,[this].concat(c)),f=e.length,g=0,h=this.length;g<h;g++)
                    g<f?this[g]=e[g]:delete this[g];
                return this.length=f,this
            })
        }),a.fn.tsort=a.fn.tinysort
    }
);