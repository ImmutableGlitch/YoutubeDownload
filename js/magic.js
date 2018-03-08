// Allow download on chriscomputing.tech but not .tk
$(document).ready(function () {
  if (document.URL.includes('chriscomputing.tk')) {
    $('#btnDown').attr("onClick","wip()")
  }
})

function selectCheck (choice) {
  var elem = document.getElementsByName('cBox')
  for (var i = 0; i < elem.length; i++) {
    if (choice == 'ALL') {
      elem[i].checked = true
    }
    else if (choice == 'NONE') {
      elem[i].checked = false
    }
  }
}

function wip () {
  alert('Not working yet :/')
}

function beginDownload () {
  $('#feedback').show().html('Starting Download...')
  link_data = []

  // Grab video id which is stored in the hidden span tags
  $(':checked+span').each(function (index) {
    // Add to array
    link_data.push($(this).text())
     console.log(index + ': ' + $(this).text())
  })

  // Post video id list to PHP file
  $.ajax({
    type: 'POST',
    url: '/php/runScraper.php',
    data: { id_list: link_data }, // Key,value
    // Provide user with response
    success: function (res) {
      // Response is a comma separated string
      // Split this into an array for opening links separately
      // Last element will be blank string!
      var download_links = res.split(',')
      console.log('Download links...')
      console.log(download_links)

      download_links.forEach(function (e) {
        // Need to disable popups for following line to work
        // as it will open the download links in a new tab
        if (e.length > 1) {
          window.open(e, '_blank')
        }
      }, this)
    }
  })
}
