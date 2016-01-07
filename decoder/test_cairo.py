import svgutils
import sys
from os.path import join as pathjoin, dirname, realpath
from os import close, stat, write, unlink

def resource(filename):
    self_dir = dirname(__file__) or '.'
    for path_dir in [self_dir] + sys.path:
        candidate_file = pathjoin(path_dir, filename)
        try:
            sb = stat(candidate_file)
            return realpath(candidate_file)
        except:
            pass
    return realpath(filename)

font_file = resource('fonts/Helvetica.ttf')
print font_file
f = svgutils.create_cairo_font_face_for_file(font_file)
assert f
