import os
from setuptools import setup, find_packages


os.environ['COPYFILE_DISABLE'] = 'true'

# Packages
MOD_NAME = "fluidsurvey-doc"
PKGS = [x for x in find_packages() if x.split('.')[0] == MOD_NAME]

###############################################################################
# Helpers.
###############################################################################
def read_file(name):
    """Read file name (without extension) to string."""
    cur_path = os.path.dirname(__file__)
    exts = ('txt', 'rst')
    for ext in exts:
        path = os.path.join(cur_path, '.'.join((name, ext)))
        if os.path.exists(path):
            with open(path, 'rt') as file_obj:
                return file_obj.read()

    return ''


###############################################################################
# Setup.
###############################################################################
setup(
    name="fluidsurvey-doc",
    version='2.0',
    use_2to3=True,
    description="FluidSurvey Documentation",
    long_description=read_file("README"),
    url="http://fluidsurvey.com",

    classifiers=[
        "Development Status :: 2 - Production/Stable",
        "Environment :: Web Environment",
        "Intended Audience :: Developers",
        "Intended Audience :: System Administrators",
        "License :: OSI Approved :: MIT License",
        "Operating System :: OS Independent",
        "Programming Language :: Python",
        "Topic :: Internet",
        "Topic :: Software Development :: Documentation",
    ],

    install_requires=[
        "setuptools",
    ],

    packages=PKGS,
    include_package_data=True,
)