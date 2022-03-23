using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace RestaurantManagementSystem
{
    public partial class FormLogin : Form
    {
        public static string name;
        public FormLogin()
        {
            InitializeComponent();
        }

        private void Form1_Load(object sender, EventArgs e)
        {

        }

        private void pnlPicture_Paint(object sender, PaintEventArgs e)
        {

        }

        private void lblUserName_Click(object sender, EventArgs e)
        {

        }

        private void lblPassword_Click(object sender, EventArgs e)
        {

        }

        private void btnClear_Click(object sender, EventArgs e)
        {
            txtUserID.Text = txtPassword.Text = null;
        }

        private void btnLogin_Click(object sender, EventArgs e)
        {

            try
            {
                string query = "select * from UserInformation where ID='"+txtUserID.Text+"'  and [Password]='"+txtPassword.Text+"'";
                DataTable dt = DataAccess.Data(query);
                string identity = dt.Rows[0]["Post"].ToString();
                name = dt.Rows[0]["Name"].ToString();
                if (dt.Rows.Count == 1 && identity.Equals("Admin"))
                {
                    AdminForm af = new AdminForm();
                    af.Show();
                    this.Hide();
                }
                else if (dt.Rows.Count == 1 && identity.Equals("Manager"))
                {
                    ManagerForm mf = new ManagerForm();
                    mf.Show();
                    this.Hide();
                }
                else if (dt.Rows.Count == 1 && identity.Equals("Waiter"))
                {
                    WaiterForm wf = new WaiterForm();
                    wf.Show();
                    this.Hide();
                }
                else
                {
                    lblError.Visible = true;
                    return;
                }
            }
             catch(Exception ex)
            {
                MessageBox.Show(ex.Message);
            }
        }
    }
}
