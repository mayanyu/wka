/**
 * @file remove-cues-from-track.js
 */

/**
 * Remove cues from a track on video.js.
 *
 * @param {Double} start start of where we should remove the cue
 * @param {Double} end end of where the we should remove the cue
 * @param {Object} track the text track to remove the cues from
 * @private
 */
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
var removeCuesFromTrack = function removeCuesFromTrack(start, end, track) {
  var i = undefined;
  var cue = undefined;

  if (!track) {
    return;
  }

  if (!track.cues) {
    return;
  }

  i = track.cues.length;

  while (i--) {
    cue = track.cues[i];

    // Remove any overlapping cue
    if (cue.startTime <= end && cue.endTime >= start) {
      track.removeCue(cue);
    }
  }
};

exports["default"] = removeCuesFromTrack;
module.exports = exports["default"];