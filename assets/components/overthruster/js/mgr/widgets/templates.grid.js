
overThruster.grid.Templates = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        id: 'overthruster-grid-templates'
        ,url: overThruster.config.connector_url
        ,baseParams: {
            action: 'mgr/template/getlist'
        }
        ,fields: ['id','name','description']
        ,autoHeight: true
        ,paging: true
        ,remoteSort: true
        ,columns: [{
            header: _('id')
            ,dataIndex: 'id'
            ,width: 70
        },{
            header: _('overthruster.chunk')
            ,dataIndex: 'chunk'
            ,width: 200
        },{
            header: _('overthruster.original')
            ,dataIndex: 'original'
            ,width: 250
        }]
        ,tbar: [{
            text: _('overthruster.template_create')
            ,handler: this.createTemplate
            ,scope: this
        }]
    });
    overThruster.grid.Templates.superclass.constructor.call(this,config);
};
Ext.extend(overThruster.grid.Templates,MODx.grid.Grid,{
    windows: {}

    ,getMenu: function() {
        var m = [];
        m.push({
            text: _('overthruster.template_update')
            ,handler: this.updateTemplate
        });
        m.push('-');
        m.push({
            text: _('overthruster.template_remove')
            ,handler: this.removeTemplate
        });
        this.addContextMenuTemplate(m);
    }
    
    ,createTemplate: function(btn,e) {
        if (!this.windows.createTemplate) {
            this.windows.createTemplate = MODx.load({
                xtype: 'overthruster-window-template-create'
                ,listeners: {
                    'success': {fn:function() { this.refresh(); },scope:this}
                }
            });
        }
        this.windows.createTemplate.fp.getForm().reset();
        this.windows.createTemplate.show(e.target);
    }
    ,updateTemplate: function(btn,e) {
        if (!this.menu.record || !this.menu.record.id) return false;
        var r = this.menu.record;

        if (!this.windows.updateTemplate) {
            this.windows.updateTemplate = MODx.load({
                xtype: 'overthruster-window-template-update'
                ,record: r
                ,listeners: {
                    'success': {fn:function() { this.refresh(); },scope:this}
                }
            });
        }
        this.windows.updateTemplate.fp.getForm().reset();
        this.windows.updateTemplate.fp.getForm().setValues(r);
        this.windows.updateTemplate.show(e.target);
    }
    
    ,removeTemplate: function(btn,e) {
        if (!this.menu.record) return false;
        
        MODx.msg.confirm({
            title: _('overthruster.template_remove')
            ,text: _('overthruster.template_remove_confirm')
            ,url: this.config.url
            ,params: {
                action: 'mgr/template/remove'
                ,id: this.menu.record.id
            }
            ,listeners: {
                'success': {fn:function(r) { this.refresh(); },scope:this}
            }
        });
    }
});
Ext.reg('overthruster-grid-templates',overThruster.grid.Templates);




overThruster.window.CreateTemplate = function(config) {
    config = config || {};
    this.ident = config.ident || 'overthruster-mectemplate'+Ext.id();
    Ext.applyIf(config,{
        title: _('overthruster.template_create')
        ,id: this.ident
        ,height: 150
        ,width: 475
        ,url: overThruster.config.connector_url
        ,action: 'mgr/template/create'
        ,fields: [{
            xtype: 'textfield'
            ,fieldLabel: _('overthrsuter.chunk')
            ,name: 'chunk'
            ,id: this.ident+'-chunk'
            ,anchor: '100%'
        },{
            xtype: 'textarea'
            ,fieldLabel: _('overthruster.original')
            ,name: 'original'
            ,id: this.ident+'-original'
            ,anchor: '100%'
        }]
    });
    overThruster.window.CreateTemplate.superclass.constructor.call(this,config);
};
Ext.extend(overThruster.window.CreateTemplate,MODx.Window);
Ext.reg('overthruster-window-template-create',overThruster.window.CreateTemplate);


overThruster.window.UpdateTemplate = function(config) {
    config = config || {};
    this.ident = config.ident || 'overthruster-meutemplate'+Ext.id();
    Ext.applyIf(config,{
        title: _('overthruster.template_update')
        ,id: this.ident
        ,height: 150
        ,width: 475
        ,url: overThruster.config.connector_url
        ,action: 'mgr/template/update'
        ,fields: [{
            xtype: 'hidden'
            ,name: 'id'
            ,id: this.ident+'-id'
        },{
            xtype: 'textfield'
            ,fieldLabel: _('overthruster.chunk')
            ,name: 'chunk'
            ,id: this.ident+'-chunk'
            ,width: 300
        },{
            xtype: 'textarea'
            ,fieldLabel: _('overthruster.original')
            ,name: 'original'
            ,id: this.ident+'-original'
            ,width: 300
        }]
    });
    overThruster.window.UpdateTemplate.superclass.constructor.call(this,config);
};
Ext.extend(overThruster.window.UpdateTemplate,MODx.Window);
Ext.reg('overthruster-window-template-update',overThruster.window.UpdateTemplate);