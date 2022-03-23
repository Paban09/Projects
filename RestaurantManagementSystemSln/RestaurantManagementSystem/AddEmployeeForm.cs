using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using System.Data.SqlClient;

namespace RestaurantManagementSystem
{
    public partial class AddEmployeeForm : Form
    {
        private SqlConnection con = null;
        private int a = 10000, m = 1000, w = 100, salary, sal;
        private string id, gender, maritalStatus,blood, address, post,aa,mm,ww;
        private DateTime dob, joining;

        private void txtConfirmPassword_TextChanged(object sender, EventArgs e)
        {
            if (txtPassword.Text != txtConfirmPassword.Text)
            {
                lblError.Visible = true;
                return;
            }
            else
                lblError.Visible = false;

        }

        private void txtID_TextChanged(object sender, EventArgs e)
        {
            post = cmbPost.SelectedItem.ToString();

            if (post.Equals("Admin"))
            {
                aa = a++.ToString();
                id = "A-" + aa;
            }
            else if (post.Equals("Manager"))
            {
                mm = m++.ToString();
                id = "M-" + mm;
            }
            else
            {
                ww = w++.ToString();
                id = "W-" + ww;
            }
            txtID.Text = id;
        }
        public AddEmployeeForm()
        {
            InitializeComponent();
        }

        private void rbFemale_CheckedChanged(object sender, EventArgs e)
        {

        }

        private void lblPost_Click(object sender, EventArgs e)
        {

        }

        private void lblEmail_Click(object sender, EventArgs e)
        {

        }

        private void lblJoining_Click(object sender, EventArgs e)
        {

        }

        private void pnlAddEmp_Paint(object sender, PaintEventArgs e)
        {

        }

        private void btnSave_Click(object sender, EventArgs e)
        {

            string uname = txtName.Text;

            string pass = txtPassword.Text;

            string mail = txtEmail.Text;

            string phn = txtPhone.Text;

            if (rbMale.Checked)
                gender = "male";
            else if (rbFemale.Checked)
                gender = "Female";

            dob = Convert.ToDateTime(dtpDOB.Text);

            joining = Convert.ToDateTime(dtpJoiningDate.Text);

            if (rbMarried.Checked)
                maritalStatus = "Married";
            else if (rbUnmarried.Checked)
                maritalStatus = "Unmarried";

            if (cmbBloodGroup.Equals("A+"))
                blood = "A+";
            else if (cmbBloodGroup.Equals("A-"))
                blood = "A-";
            else if (cmbBloodGroup.Equals("B+"))
                blood = "B+";
            else if (cmbBloodGroup.Equals("B-"))
                blood = "B-";
            else if (cmbBloodGroup.Equals("AB+"))
                blood = "AB+";
            else if (cmbBloodGroup.Equals("AB-"))
                blood = "AB-";
            else if (cmbBloodGroup.Equals("O+"))
                blood = "O+";
            else if (cmbBloodGroup.Equals("O-"))
                blood = "O-";

            if (Int32.TryParse(txtSalary.Text, out sal))
                this.salary = sal;
            else
                MessageBox.Show("Enter a valid salary");

            address = txtAddress.Text;

            try
            {
                con = new SqlConnection(@"Data Source=WALTON_Prelude;Initial Catalog=RestaurantManagementSystemDatabase;Integrated Security=True");
                con.Open();
                string query = "insert into UserInformation values('"+txtID.Text+"','"+uname+"','"+pass+"','"+post+"','"+mail+"','"+phn+"','"+gender+"', '"+dob+"', '"+joining+"','"+maritalStatus+"','"+blood+"',"+salary+",'"+address+"')";
                SqlCommand cmd = new SqlCommand(query,con);
                cmd.ExecuteNonQuery();
                MessageBox.Show("Successfully added");
            }
            catch (Exception ex)
            {
                MessageBox.Show(ex.Message);
            }
            finally
            {
                con.Close();
            }
        }
    }
}
