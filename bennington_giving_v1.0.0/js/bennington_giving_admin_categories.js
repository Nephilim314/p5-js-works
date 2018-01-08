(function ($) {

  'use strict';
  var baseUrl = '/admin/bennington-fund/donor-roll/manage-categories';

  var Categories = {
    currentActions: null,

    init: function(){
      this.addAddButton();
      this.attachListeners();
    },

    handleResponse: function(resp) {
      try {
        switch(resp[0].command) {
          case 'alert':
            return alert(resp[0].text);
            break;
          case 'redirect':
            return window.location = resp[0].url;
            break;
        }
      } catch (e) {
        console.log(e);
      }

      console.log(resp);

    },

    addAddButton: function(){
      var btn = $('<button class="button button--primary" style="margin: 10px;" id="add-category-button">Add Category</button>');
      btn.on('click', function(){
        $(this).hide();
        var input = $('<input type="text" id="new-category-name" placeholder="New category..."/>');
        var submit = $('<button class="button button--primary">Save</button>');
        var cancel = $('<button class="button">Cancel</button>');
        submit.on('click', function(){
          if($.trim(input.val()) == '') return;
          $.post(baseUrl +'/new', {
            name: input.val(),
          }, Categories.handleResponse)
        })
        input.on('keydown', function(e){
          if(e.which == 13) submit.trigger('click');
        })
        cancel.on('click', function(){
          console.log("Cancelling");
          $('#new-category-form').remove();
          $(this).show()
        }.bind(this))
        var container = $('<div id="new-category-form"></div>')
        container.css('margin', '10px');
        container.append(input);
        container.append(submit);
        container.append(cancel);
        container.insertBefore($('#category-table'));
      })
      btn.insertBefore($('#category-table'));
    },

    attachListeners: function(){
      console.log("Attaching Listeners");
      $('.action-link').on('click', this.handleAction);
    },

    handleAction: function(e) {
      var id = $(this).attr('idx');
      var action = $(this).attr('action');

      var row = $('#category_'+id+'_row');
      var action_col = row.find('td').last();
      Categories.currentActions = action_col;
      Categories.currentCategory = id;
      Categories[action](id);
    },

    remove: function(id) {
      Categories.addCancelButton();
      var text = $('<span>Are you sure?</span>')
      var submit = $('<button class="button danger">Yes, remove</button>');
      submit.on('click', function(){
        $.post(baseUrl +'/delete', {id: id}, Categories.handleResponse);
      });

      Categories.setActionInstructions([text, submit]);
    },

    rename: function(id) {
      Categories.addCancelButton();
      var input = $('<input type="text" id="category-name" placeholder="Rename category..."/>');
      var submit = $('<button class="button button--primary">Save</button>');
      submit.on('click', function(){
        $.post(baseUrl +'/rename', {
          id: id,
          name: $('#category-name').val(),
        }, Categories.handleResponse)
      });
      input.on('keydown', function(e) {
        if(e.which == '13') {
          submit.trigger('click');
        }
      })
      Categories.setActionInstructions([input, submit]);
    },

    unnest: function(id) {
      $.post(baseUrl +'/unnest',{'id': id}, Categories.handleResponse)
    },

    nest: function(id) {
      Categories.addCancelButton();
      Categories.setActionInstructions('Choose the category to nest under.');
      Categories.currentActions.closest('table').find('tr').each(function(i, el) {
        if($(el).attr('id') == 'category_'+ id +'_row') return;
        Categories.makeClickable($(el).find('td').first(), function(clicked) {
          Categories.nestTo(clicked);
        })
      });
    },

    nestTo: function(el) {
      var id = el.closest('tr').attr('id').split('_')[1];
      console.log('Nesting to: '+id);
      $.post(baseUrl +'/nest', {
        'id': Categories.currentCategory,
        'to': id,
      }, function(data) {
        Categories.handleResponse(data);
        Categories.cancelAction();
      });
    },

    makeClickable: function(el, callback) {
      $(el).addClass("clickable");
      $(el).on('click', function(){
        Categories.unmakeClickable();
        callback($(this));
      })
    },

    unmakeClickable: function(){
      $('.clickable').removeClass("clickable");
      $('.clickable').off('click');
    },

    addCancelButton: function() {
      var el = $('<button id="cancel-action" class="button">Cancel</button>');
      Categories.currentActions.append(el);
      el.one('click', function(){ 
        Categories.cancelAction();
      });
    },

    cancelAction: function() {
      this.unsetActionInstructions();
      this.unmakeClickable();
      $('#cancel-action').remove();
    },

    setActionInstructions: function(instruction) {
      Categories.currentActions.closest('table').find('.actions').hide();
      if(typeof instruction == 'array') {
        Categories.currentActions.append(instruction);
        Categories.currentActions.find('input')[0].focus();
      } else {
        Categories.currentActions.find('.instructions').html(instruction);
      }
      Categories.currentActions.find('.instructions').show();
    },

    unsetActionInstructions: function() {
      Categories.currentActions.closest('table').find('.actions').show();
      Categories.currentActions.find('.instructions').hide();
      Categories.currentActions.find('.instructions').children().remove();
    }
  };

  $(function () {
    console.log('Loaded categories');
    Categories.init();
  });
})(jQuery);