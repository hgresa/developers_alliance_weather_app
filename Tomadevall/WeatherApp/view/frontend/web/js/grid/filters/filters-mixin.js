define(['jquery', 'underscore', 'mageUtils'], function ($, _, utils) {
    'use strict'

    /**
     * Removes empty properties from the provided object.
     *
     * @param {Object} data - Object to be processed.
     * @returns {Object}
     */
    function removeEmpty(data) {
        var result = utils.mapRecursive(data, utils.removeEmptyValues.bind(utils));

        return utils.mapRecursive(result, function (value) {
            return _.isString(value) ? value.trim() : value;
        });
    }

    return function (Component) {
        return Component.extend({
            apply: function () {
                this.set('applied', removeEmpty(this.filters));

                return this
            }
        })
    }
})
