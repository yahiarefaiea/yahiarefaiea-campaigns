var Form = {
  //  DATA
  data: function() {
    return {
      from: $('[name=from]').val(),
      subject: $('[name=subject]').val(),
      to: JSON.parse($('[name=to]').val()),
      message: $('[name=message]').val()
    }
  },

  //  SUBMIT
  submit: function() {
    $.ajax({
      type: 'POST',
      url: 'includes/php/form.php',
      data: {dd: JSON.stringify(Form.data())},
      dataType: 'json',
      error: function(XMLHttpRequest, textStatus, errorThrown) {
        $('#callback').text('error')
      },
      success: function(data) {
        $('[name=submit]').remove()
        $('#callback').text(data.status)
      }
    })
  }
}

//  DOCUMENT READY
$(document).ready(function() {
  $('[name=submit]').on('click', function() {
    Form.submit()
  })
})
