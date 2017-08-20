
if (typeof jQuery === 'undefined') {
  throw new Error('Bootstrap\'s JavaScript requires jQuery')
}

+function($) {
	var Pagination = function(element, option) {
		this.curpage = -1;
		this.totalitems = -1;
		this.countperpage = 10;
		this.pagecount = 0;
		this.domPagination = $(element);
		this.updateUI(option);
	}

	Pagination.prototype.updateUI = function(opt) {
        this.totalitems = opt.totalitems;
        this.curpage = opt.curpage;
        this.countperpage = opt.countperpage;
        this.pagecount = Math.floor((opt.totalitems-1)/opt.countperpage)+1;

        this.domPagination.find("li").remove();

        var pageStart = Math.max(this.curpage-2, 0);
        var pageEnd = Math.min(pageStart+5, this.pagecount);
        if (pageEnd-5 < pageStart && pageEnd-5>=0) {
        	pageStart = pageEnd-5;
        };
        if (pageStart > 0) {
        	this.domPagination.append($('<li class="pagination-btn" data-page="0"><a>1</a></li>'));
        };
        if (pageStart > 1) {
        	this.domPagination.append($('<li><a>...</a></li>'));
        };
        for (var i = pageStart; i < pageEnd; i++) {
        	var domPage = $('<li class="pagination-btn" data-page="'+i+'"><a>'+(i+1)+'</a></li>');
        	if (i == this.curpage) {
        		domPage.addClass("active");
        	};
        	this.domPagination.append(domPage);
        };
        if (pageEnd < this.pagecount-1) {
        	this.domPagination.append($('<li><a>…</a></li>'));
        };
        if (pageEnd < this.pagecount) {
        	this.domPagination.append($('<li class="pagination-btn" data-page="'+(this.pagecount-1)+'"><a>'+this.pagecount+'</a></li>'));
        };

        var self = this;
        this.domPagination.find(".pagination-btn").click(function(){
        	var pageSel = $(this).attr("data-page");
        	self.updateUI({
				curpage: pageSel,
				totalitems: self.totalitems,
				countperpage: self.countperpage
			});
			self.domPagination.trigger({
				type: "changePage",
				pageSel : pageSel
			})
        });
	}

	function Plugin(option, callfunc) {
		return this.each(function () {
			var $this = $(this)
			var data  = $this.data('bs.pagination')

			if (!data) $this.data('bs.pagination', (data = new Pagination(this, option)))
			if (typeof callfunc == 'string') {
				$this.curpage = option.curpage;
				$this.totalitems = option.totalitems;
				$this.countperpage = option.countperpage;

				data[callfunc].call(data, option);
			}
		})
	}

	$.fn.pagination = Plugin;
	$.fn.pagination.Constructor = Pagination;

}(jQuery)